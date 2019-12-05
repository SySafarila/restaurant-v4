<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Auth::user();

        return view('profile.index', ['profile' => $profile]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function edit2()
    {
        $user = Auth::user();
        // return $user;
        return view('profile.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $validate = $request->validate([
            'name' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'username' => 'required|min:5|alpha_num|'. Rule::unique('users')->ignore($user->id),
            'phone' => 'required|digits_between:10,13|numeric|' . Rule::unique('users')->ignore($user->id),
            'address' => 'required|min:7|string',
            'gender' => 'required|in:female,male',
            // 'level' => 'required|in:Owner,Admin,Cashier,Waiter,Customer',
            // 'status' => 'required|in:Active,Nonactive',
        ]);
        $user = Auth::user();
        $edit = User::where('id', $user->id)->update([
            'name' => ucwords($request['name']), //uppercase for each word
            'username' => strtolower($request['username']), //lowercase for each word
            'phone' => $request['phone'],
            'address' => ucwords($request['address']), //uppercase for each word
            'gender' => $request['gender'],
            // 'level' => $request['level'],
            // 'status' => $request['status'],
        ]);
        return redirect()->route('profile.index')->with('status', 'Profile Updated !');
    }

    public function editlogin()
    {
        $user = Auth::user();

        return view('profile.editlogin', ['user' => $user]);
    }

    public function updatelogin(Request $request)
    {
        $user = Auth::user();

        $validate = $request->validate([
            'email' => 'required|min:13|email|'. Rule::unique('users')->ignore($user->id),
            'password' => 'required|string|min:8|confirmed'
        ]);
        
        $edit = User::where('id', $user->id)->update([
            'email' => strtolower($request['email']),
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->route('profile.index')->with('status', 'Login Information Updated !');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = Auth::user();
        $delete = User::find($user->id);
        $delete->delete();
        
        return redirect()->route('login')->with('status', 'Profile deleted and unregistered !');
    }
}
