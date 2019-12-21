<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenusController extends Controller
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
        $menus  = Menu::orderBy('name', 'asc')->get();
        $number = 1;

        // dd($menus);

        return view('menus.index', ['menus' => $menus, 'number' => $number]);
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
        $validate = $request->validate([
            'name'        => 'string|min:5|required',
            'description' => 'string|min:10|required',
            'price'       => 'numeric|digits_between:3,9999|required',
            'img'         => 'string|required',
            'stock'       => 'numeric|digits_between:1,9999|required',
            'status'      => 'in:Available,Unavailable|required'
        ]);

        Menu::create([
            'name'        => ucwords($request['name']),
            'description' => ucwords($request['description']),
            'price'       => $request['price'],
            'img'         => $request['img'],
            'stock'       => $request['stock'],
            'status'      => ucwords($request['status'])
        ]);

        return redirect()->route('menus.index')->with('status_menu', 'Menu added !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::findOrFail($id);

        // return $menu;

        return view('menus.show', ['menu' => $menu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        // return $menu;

        return view('menus.edit', ['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name'        => 'string|min:5|required',
            'description' => 'string|min:10|required',
            'price'       => 'numeric|digits_between:3,9999|required',
            'img'         => 'string|required',
            'stock'       => 'numeric|digits_between:1,9999|required',
            'status'      => 'in:Available,Unavailable|required'
        ]);

        Menu::where('id', $id)->update([
            'name'        => ucwords($request['name']),
            'description' => ucwords($request['description']),
            'price'       => $request['price'],
            'img'         => $request['img'],
            'stock'       => $request['stock'],
            'status'      => ucwords($request['status'])
        ]);

        return redirect()->route('menus.index')->with('status_menu', 'Menu edited !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menus.index')->with('status', 'Menu deleted !');
    }
}
