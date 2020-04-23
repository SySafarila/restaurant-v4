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
        $image = Storage::download('menuImages/1-image-1.png');
        return $image;
    }
}
