<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkUserStatus']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Auth::user();
        $avatar = Storage::url('avatars/user/' . $profile->img);

        return view('profile.index', ['profile' => $profile, 'avatar' => $avatar]);
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
            'name'     => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'username' => 'required|min:5|regex:[^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$]|' . Rule::unique('users')->ignore($user->id),
            'phone'    => 'required|digits_between:10,13|numeric|' . Rule::unique('users')->ignore($user->id),
            'address'  => 'required|min:7|string',
            'gender'   => 'required|in:Female,Male',
        ]);
        // $user = Auth::user();
        User::where('id', $user->id)->update([
            'name'     => ucwords($request['name']), //uppercase for each word
            'username' => strtolower($request['username']), //lowercase for each word
            'phone'    => $request['phone'],
            'address'  => ucwords($request['address']), //uppercase for each word
            'gender'   => $request['gender'],
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

        $request->validate([
            'email'    => 'required|min:13|email|' . Rule::unique('users')->ignore($user->id),
            'password' => 'required|string|min:8|confirmed'
        ]);

        User::where('id', $user->id)->update([
            'email'    => strtolower($request['email']),
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
        $user   = Auth::user();

        if (!$user->img == null) {
            $avatar = Storage::delete('public/avatars/user/' . $user->img);
        }

        $delete = User::find($user->id);
        $delete->delete();

        return redirect()->route('login')->with('status', 'Profile deleted and unregistered !');
    }

    public function editAvatar()
    {
        if (Auth::user()->img == null) {
            return view('profile.editAvatar');
        }

        return redirect()->route('profile.index')->with('status-warning', 'Delete first your avatar');
    }

    public function updateAvatar(Request $request)
    {
        $validate = $request->validate(
            [
                'avatar' => ['required', 'mimes:jpg,jpeg,png', 'max:5120'],
            ],
            [
                'avatar.max' => 'Maximum file size for avatar is 5MB.',
                'avatar.mimes' => 'Extensions allowed is : JPG, JPEG, and PNG.'
            ]
        );
        if ($request->user()->img == null) {

            $fileName = $request->user()->id . '.' . $request->file('avatar')->getClientOriginalExtension();
            $avatar = $request->file('avatar')->storeAs('public/avatars/user', $fileName);

            $update = User::where('id', $request->user()->id)->update([
                'img' => $fileName,
            ]);
            return redirect()->route('profile.index')->with('status', 'Avatar Updated !');
        } else {
            return redirect()->route('profile.index');
        }
    }

    public function deleteAvatar()
    {
        if (Auth::user()->img == null) {
            return redirect()->route('profile.index');
        } else {
            $profile = Auth::user();

            if (Storage::disk('local')->exists('public/avatars/user/' . $profile->img) == true) {
                Storage::delete('public/avatars/user/' . $profile->img);
            }
            User::where('id', $profile->id)->update([
                'img' => null,
            ]);

            return redirect()->route('profile.index')->with('status', 'Avatar Deleted !');
        }
    }
}
