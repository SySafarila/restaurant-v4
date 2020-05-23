<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Notification;
use App\Refund;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChefController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkUserStatus', 'chef']);
    }

    public function index()
    {
        $orders = Invoice::whereIn('status', ['Pending', 'Cooking', 'Success'])->get();
        $success = Invoice::where(['status' => 'Success', 'chef' => '@' . Auth::user()->username])->paginate(5);
        return view('chef.index', ['orders' => $orders, 'success' => $success]);
    }

    public function cooking($id)
    {
        if (Invoice::find($id)->status == 'Cooking') {
            return redirect()->route('kitchen.index')->with('status-warning', 'Warning, Menu is already Cooked');
        }
        Invoice::where(['id' => $id, 'status' => 'Pending'])->update([
            'status' => 'Cooking',
            'chef' => '@' . Auth::user()->username
        ]);

        $menu = Invoice::find($id);

        Notification::create([
            'message' => 'Your order <b>' . $menu->menu . ' | ' . $menu->code . '</b> is on Cooking right now.',
            'status' => false,
            'user_id' => $menu->user_id
        ]);

        return redirect()->route('kitchen.index')->with('status-success', 'Menu set to Cooking !');
    }

    public function success($id)
    {
        if (Invoice::find($id)->status == 'Success') {
            return redirect()->route('kitchen.index')->with('status-warning', 'Warning, Menu is already Successed');
        }
        Invoice::where(['id' => $id, 'status' => 'Cooking'])->update([
            'status' => 'Success',
            'chef' => '@' . Auth::user()->username
        ]);

        $menu = Invoice::find($id);

        Notification::create([
            'message' => 'Your order <b>' . $menu->menu . ' | ' . $menu->code . '</b> is already to take.',
            'status' => false,
            'user_id' => $menu->user_id
        ]);

        return redirect()->route('kitchen.index')->with('status-success', 'Menu set to Success !');
    }

    public function outOfStock($id)
    {
        $admins = User::where('level', 'Admin')->get();
        if (!Invoice::find($id)->status == 'Pending') {
            return redirect()->route('kitchen.index')->with('status-warning', 'Something error !');
        }

        Invoice::where(['id' => $id, 'status' => 'Pending'])->update([
            'status' => 'Out Of Stock',
            'chef' => '@' . Auth::user()->username
        ]);

        $invoice = Invoice::find($id);

        Refund::create([
            'user_id' => $invoice->user->id,
            'invoice_code' => $invoice->invoice_code->code,
            'menu' => $invoice->menu,
            'menu_price' => $invoice->total,
            'menu_quantity' => $invoice->quantity,
            'refund' => $invoice->total,
            'status' => 'Pending'
        ]);

        Notification::create([
            'message' => 'Your order <b>' . $invoice->menu . ' | ' . $invoice->code . '</b> is out of stock, go to Admin"s for the refund.',
            'status' => false,
            'user_id' => $invoice->user_id
        ]);

        foreach ($admins as $admin) {
            Notification::create([
                'message' => '1 refund for <b>@' . $invoice->user->username . '</b> is pending.',
                'status' => false,
                'user_id' => $admin->id
            ]);
        }

        return redirect()->route('kitchen.index')->with('status-warning', 'Menu set to Out Of Stock !');
    }

    public function show($id)
    {
        return abort(404);
    }
}
