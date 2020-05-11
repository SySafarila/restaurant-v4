<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SetAdmin extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function index()
    {
        // return view();
    }

    public function setAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|min:5'
        ]);

        if (User::where('email', $request->email)->first()->count() == 0) {
            return 'User not found';
        } else {
            User::where('email', $request->email)->first()->update([
                'level' => 'Admin'
            ]);
            return 'ok';
        }
    }

    public function deleteAdmin(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric'
        ]);

        if (User::find($request->id) == true) {
            User::find($request->id)->update([
                'level' => 'Customer'
            ]);
    
            return 'ok';
        } else {
            return 'user not found';
        }
    }
}
