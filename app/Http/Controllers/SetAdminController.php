<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SetAdminController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'checkUserStatus', 'owner']);
    }
    
    public function index()
    {
        $admins = User::where('level', 'Admin')->get();
        return view('settings.add-admin', ['admins' => $admins]);
    }

    public function setAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|min:5|exists:users,email'
        ],[
            'email.exists' => 'Email or User not found'
        ]);
        $check = User::where('email', $request->email)->first()->level;
        if ($check == 'Admin') {
            return redirect()->route('addAdmin.index')->with('status-warning', 'User is Admin');
        } else {
            User::where('email', $request->email)->first()->update([
                'level' => 'Admin'
            ]);
            return redirect()->route('addAdmin.index')->with('status-success', 'Admin added !');
        }
    }

    public function deleteAdmin(Request $request, $id)
    {
        // return $request;
        // $request->validate([
        //     'id' => 'required|numeric|exists:users,id'
        // ]);

        if (User::find($id)->level == 'Admin') {
            User::find($id)->update([
                'level' => 'Customer'
            ]);
    
            return redirect()->route('addAdmin.index')->with('status-success', 'Admin deleted !');
        } else {
            return '404';
        }
    }
}
