<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Notification;
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
        return view('chef.index', ['orders' => $orders]);
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
        // Update invoice->menu->status to Out Of Stock.
        Invoice::where(['id' => $id, 'status' => 'Pending'])->update([
            'status' => 'Out Of Stock'
        ]);

        return 'Updated to Out Of Stock !';
    }

    public function show($id)
    {
        return abort(404);
    }
}
