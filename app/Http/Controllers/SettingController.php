<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkUserStatus']);
    }

    public function index()
    {
        $profile = Auth::user();
        $avatar = Storage::url('avatars/user/' . $profile->img);

        return view('setting.index', ['profile' => $profile, 'avatar' => $avatar]);
    }
}
