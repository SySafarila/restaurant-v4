<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Notification;
use Illuminate\Http\Request;

class ChefController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkUserStatus', 'chef']);
    }

    public function index()
    {
        $orders = Invoice::whereIn('status', ['Pending', 'Cooking'])->get();
        return view('chef.index', ['orders' => $orders]);
    }

    public function cooking($id)
    {
        if (Invoice::find($id)->status == 'Cooking') {
            return redirect()->route('kitchen.index')->with('status-warning', 'Warning, Menu is already cooking');
        }
        Invoice::where(['id' => $id, 'status' => 'Pending'])->update([
            'status' => 'Cooking'
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
        // Update invoice->menu->status to Success.
        Invoice::where(['id' => $id, 'status' => 'Cooking'])->update([
            'status' => 'Success'
        ]);

        return 'Updated to Success !';
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
