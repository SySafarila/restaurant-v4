<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Refund;
use Illuminate\Http\Request;

class RefundsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkUserStatus', 'admin']);
    }

    public function index()
    {
        $refunds = Refund::all();
        return view('refunds.index', ['refunds' => $refunds]);
    }

    public function update($id)
    {
        $refund = Refund::find($id);
        if ($refund->status == 'Success') {
            return redirect()->route('refunds.index')->with('status-warning', 'Something error happened');
        }
        Refund::where('id', $id)->update([
            'status' => 'Success'
        ]);
        
        Notification::create([
            'message' => 'You got refund of <b>Rp ' . number_format($refund->refund,0 ,0, '.') . '</b> with Invoice Code is <b>' . $refund->invoice_code . '</b>.',
            'status' => false,
            'user_id' => $refund->user_id
        ]);
        return redirect()->route('refunds.index')->with('status-success', 'Refund Success');
    }

    public function success()
    {
        $refunds = Refund::where('status', 'Success')->latest()->paginate(10);
        return view('refunds.success', ['refunds' => $refunds]);
    }
}
