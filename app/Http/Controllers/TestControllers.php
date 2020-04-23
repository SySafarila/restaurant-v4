<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Menu_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestControllers extends Controller
{
    public function index()
    {
        $image = Storage::move('public/menuImages/1-image-1.png', 'menuImages/1-image-1.png');
    }
}
