<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->level == 'Admin' || Auth::user()->level == 'Customer') {
            $layout = 'layouts.app';
        } else {
            $layout = 'layouts.cashier';
        }

        return view('dashboard', ['layout' => $layout]);
    }

    // public function getBrowser()
    // {
    //     dd(get_browser(null, true));
    // }
}
