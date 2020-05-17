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
        
        return view('settings.account', ['profile' => $profile, 'avatar' => $avatar]);
    }
    
    public function overview()
    {
        $user = Auth::user();
        $avatar = Storage::url('avatars/user/' . $user->img);
        return view('settings.overview', ['user' => $user, 'avatar' => $avatar]);
    }
}
