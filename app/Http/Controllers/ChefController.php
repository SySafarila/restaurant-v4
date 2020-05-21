<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class ChefController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkUserStatus', 'chef']);
    }
    
    public function index()
    {
        // $pending = Invoice::where(['status' => 'Pending'])->get();
        // $cooking = Invoice::where(['status' => 'Cooking'])->get();
        $orders = Invoice::whereIn('status', ['Pending', 'Cooking'])->get();
        return view('chef.index', ['orders' => $orders]);
    }

    public function cooking($id)
    {
        // Update invoice->menu->status to Cooking.
        Invoice::where(['id' => $id, 'status' => 'Pending'])->update([
            'status' => 'Cooking'
        ]);

        return 'Updated to Cooking !';
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
}
