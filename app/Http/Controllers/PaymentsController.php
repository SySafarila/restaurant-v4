<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin', 'checkUserStatus']);
    }

    public function index()
    {
        return view('payments.index');
    }
}
