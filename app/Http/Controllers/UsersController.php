<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
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
        if (Auth::user()->level == 'Admin') {
            $users  = User::orderBy('name', 'asc')->get();
            $number = 1;

            return view('users.index', ['users' => $users, 'number' => $number]);
        } else {
            if (Auth::user()->level == 'Owner') {
                $users  = User::orderBy('name', 'asc')->get();
                $number = 1;

                return view('users.index', ['users' => $users, 'number' => $number]);
            } else {
                return redirect()->route('dashboard')->with('status-denied', 'Access Denied For Admin Panel');
            }
            
        }
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
    public function show(User $user)
    {
        // return $user;
        $user = $user;

        if ($user->level == 'Admin') {
            $badge = 'badge-success';
        } else {
            $badge = 'badge-secondary';
        }
        
        // return $user;
        // dd($user);

        return view('users.show', ['user' => $user, 'badge' => $badge]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name'     => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'username' => 'required|min:5|regex:[^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$]|'. Rule::unique('users')->ignore($id),
            'phone'    => 'required|digits_between:10,13|numeric|' . Rule::unique('users')->ignore($id),
            'address'  => 'required|min:7|string',
            'gender'   => 'required|in:Female,Male',
            'level'    => 'required|in:Owner,Admin,Cashier,Waiter,Customer',
            'status'   => 'required|in:Active,Nonactive',
        ]);
        $user = Auth::user();
        $edit = User::where('id', $id)->update([
            'name'     => ucwords($request['name']), //uppercase for each word
            'username' => strtolower($request['username']), //lowercase for each word
            'phone'    => $request['phone'],
            'address'  => ucwords($request['address']), //uppercase for each word
            'gender'   => ucwords($request['gender']),
            'level'    => ucwords($request['level']),
            'status'   => ucwords($request['status']),
        ]);

        return redirect()->route('users.show', $request->username)->with('status', 'User updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('users.index')->with('status', 'User has been deleted !');
    }

    public function search(Request $request)
    {
        $username = $request->username;

        return redirect()->route('users.payment', $username);
        // if (Auth::user()->level == 'Admin') {
        //     $validate = $request->validate([
        //         'username' => 'required',
        //     ]);
        //     $username = $request['username'];
        //     $number   = 1;
        //     $user     = User::where(['username' => $username, 'Level' => 'Customer'])->firstOrFail();
    
        //     return view('users.search', ['user' => $user, 'number' => $number]);
        // } else {
        //     return redirect()->route('dashboard');
        // }
    }

    public function search2($username)
    {
        // $user = User::where('username', $username)->firstOrFail();

        // // return $user->username;

        // if (Auth::user()->level == 'Admin') {
        //     // $validate = $request->validate([
        //     //     'username' => 'required',
        //     // ]);
        //     // $username = $request['username'];
        //     $number   = 1;
        //     $user     = User::where(['username' => $username, 'Level' => 'Customer'])->firstOrFail();
    
        //     return view('users.search', ['user' => $user, 'number' => $number]);
        // } else {
        //     return redirect()->route('dashboard');
        // }
    }

    public function payment(User $user)
    {
        // return $user;
        // $username = $user;
        $user = $user;
        $number   = 1;

        return view('users.search', ['user' => $user, 'number' => $number]);
    }
}