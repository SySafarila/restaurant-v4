<?php

namespace App\Http\Controllers;

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
}
