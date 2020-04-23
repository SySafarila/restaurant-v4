<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Menu_image;
use Illuminate\Http\Request;

class TesControllers extends Controller
{
    public function index()
    {
        // Menu_image::create([
        //     'name' => 'asdasdf',
        //     'menu_id' => 1
        // ]);
        // $images = Menu_image::first();
        // return $images->menu;
        $menu = Menu::find(1);
        return $menu->images;
    }
}
