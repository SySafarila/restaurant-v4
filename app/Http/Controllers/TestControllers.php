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
        return Menu_image::orderBy('id', 'desc')->first()->id;
    }
}
