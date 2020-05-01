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
            'cover_image' => 'required|mimes:jpg,jpeg,png|max:5120',
            'images[]'   => 'mimes:jpg,jpeg,png|max:10120',
        ]);
        
        Menu::create([
            'name'        => ucwords($request['name']),
            'description' => ucwords($request['description']),
            'price'       => $request['price'],
            'stock'       => intval($request['stock'])
        ]);

        if (Menu_image::all()->count() == 0) {
            $lastImage = 1;
        } else {
            $lastImage = Menu_image::orderBy('id', 'desc')->first()->id + 1;
        }

        $image1Ext = $request->file('cover_image')->getClientOriginalExtension();
        $getLastId = Menu::withTrashed()->orderBy('id', 'desc')->first()->id;
        $image1Name = 'image-cover-' . $getLastId . '.' . $image1Ext;
        
        Menu_image::create([
            'name' => $image1Name,
            'menu_id' => $getLastId
            ]);
            
        $upload = $request->file('cover_image')->storeAs('public/menuImages', $image1Name);
            
        // Other images
        if ($request->hasFile('images') == true) {
            foreach ($request->file('images') as $image) {
                if (Menu_image::all()->count() == 0) {
                    $imgOtherLastId = 1;
                } else {
                    $imgOtherLastId = Menu_image::orderBy('id', 'desc')->first()->id + 1;
                }
                $imgOtherFileName = 'image-' . $imgOtherLastId . '.' . $image->getClientOriginalExtension();

                Menu_image::create([
                    'name' => $imgOtherFileName,
                    'menu_id' => $getLastId
                ]);

                // Upload
                $image->storeAs('public/menuimages', $imgOtherFileName);
            }
        }

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
        $images = $menu->images;
        $menus = Menu::whereNotIn('id', [$id])->inRandomOrder()->paginate(4);

        return view('menus.show', ['menu' => $menu, 'menus' => $menus, 'images' => $images]);
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

        foreach ($menu->images as $image) {
            $moveImage = Storage::move('public/menuImages/' . $image->name, 'menuImages/' . $image->name);
        }
        
        // $moveImage = Storage::move('public/menuImages/' . $menu->images->first()->name, 'menuImages/' . $menu->images->first()->name);
        $menu->delete();

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
        foreach ($menu->images as $image) {
            $restoreImage = Storage::move('menuImages/' . $image->name, 'public/menuImages/' . $image->name);
        }
        
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

    public function forceDelete($id)
    {
        $menu = Menu::withTrashed()->find($id);
        foreach ($menu->images as $image) {
            $imgUrl = Storage::disk('local')->delete('menuImages/' . $image->name);
        }
        $imgDb = Menu_image::where('menu_id', $id)->forceDelete();
        $deleteMenu = $menu->forceDelete();
        return redirect()->route('menus.deleted')->with('status', 'Menu Deleted Permanent !');
    }
}
