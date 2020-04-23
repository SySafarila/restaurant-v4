<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Menu_image;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenusController extends Controller
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
        $menus  = Menu::orderBy('name', 'asc')->paginate(10);
        $number = 1;

        if (Auth::user()->level == 'Admin') {
            return view('menus.advance-index', ['menus' => $menus, 'number' => $number]);
        } else {
            return view('menus.index', ['menus' => $menus]);
        }
    }

    public function deleted()
    {
        $menus = Menu::onlyTrashed()->get();
        $count = Menu::onlyTrashed()->count();

        return view('menus.deleted', ['menus' => $menus, 'count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menus.create');
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
            'stock'       => 'numeric|digits_between:1,9999|required',
            'image_1'   => 'required|mimes:jpg,jpeg,png|max:5120',
            'image_2'   => 'mimes:jpg,jpeg,png|max:5120',
            'image_3'   => 'mimes:jpg,jpeg,png|max:5120',
            'image_4'   => 'mimes:jpg,jpeg,png|max:5120',
            'image_5'   => 'mimes:jpg,jpeg,png|max:5120',
        ]);
        
        if (Menu::all()->count() == 0) {
            $lastId = 1;
        } else {
            $lastId = Menu::orderBy('id', 'desc')->first()->id + 1;
        }
        
        // Unique
        if (Menu_image::all()->count() == 0) {
            $unique = 1;
        } else {
            $unique = Menu_image::latest()->first()->id + 1;
        }

        $fileName = $lastId . '-image-' . $unique;
        
        Menu::create([
            'name'        => ucwords($request['name']),
            'description' => ucwords($request['description']),
            'price'       => $request['price'],
            'stock'       => intval($request['stock'])
        ]);

        // Upload images 1
        $request->file('image_1')->storeAs('public/menuImages', $fileName . '.' . $request->file('image_1')->getClientOriginalExtension());
        Menu_image::create([
            'name' => $fileName . '.' . $request->file('image_1')->getClientOriginalExtension(),
            'menu_id' => $lastId
        ]);
        return redirect()->route('menus.index')->with('status', 'Menu added !');
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
        $image = $menu->images->first()->name;
        $menus = Menu::whereNotIn('id', [$id])->inRandomOrder()->paginate(4);

        return view('menus.show', ['menu' => $menu, 'menus' => $menus, 'image' => $image]);
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
            'stock'       => 'numeric|min:1|required',
        ]);

        Menu::where('id', $id)->update([
            'name'        => ucwords($request['name']),
            'description' => ucwords($request['description']),
            'price'       => $request['price'],
            'img'         => $request['img'],
            'stock'       => intval($request['stock']),
        ]);

        return redirect()->route('menus.index')->with('status', 'Menu edited !');
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
        // return $menu->images;
        $menu->delete();

        $moveImage = Storage::move('public/menuImages/' . $menu->images->first()->name, 'menuImages/' . $menu->images->first()->name);

        $order = Order::where('menu_id', $id)->delete();

        return redirect()->route('menus.index')->with('status', 'Menu moved to trash !');
    }

    public function restore(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|min:1|numeric'
        ]);
        $update = Menu::onlyTrashed()->where('id', $id)->update([
            'stock' => $request->stock
        ]);
        $restore = Menu::onlyTrashed()->where('id', $id)->restore();
        $menu = Menu::withTrashed()->where('id', $id)->first();
        $onlyTrash = Menu::onlyTrashed()->get();
        $restoreImage = Storage::move('menuImages/' . $menu->images->first()->name, 'public/menuImages/' . $menu->images->first()->name);
        if ($onlyTrash->count() == 0) {
            return redirect()->route('menus.index')->with('status', 'All Restored !');
        }

        return redirect()->route('menus.deleted')->with('status', 'Menus Restored !');
    }

    public function search(Request $request)
    {
        $menus = Menu::where('name', 'like', '%' . $request->name . '%')->orderBy('name')->paginate(10);
        if ($menus->count() == 0) {
            return abort(404);
        }
        $number = 1;

        if (Auth::user()->level == 'Admin') {
            return view('menus.advance-index', ['menus' => $menus, 'number' => $number]);
        } else {
            return view('menus.index', ['menus' => $menus, 'number' => $number]);
        }
    }
}
