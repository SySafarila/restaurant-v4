<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Menu_cover;
use App\Menu_image;
use App\Notification;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'category'    => 'required|string|in:Foods,Drinks',
            'price'       => 'numeric|digits_between:3,9999|required',
            'stock'       => 'numeric|digits_between:1,9999|required',
            'cover_image' => 'required|mimes:jpg,jpeg,png|max:5120',
            'images.*'   => 'mimes:jpg,jpeg,png|max:10120',
        ],[
            'images.*.mimes' => 'Only jpg, jpeg, and png are allowed.',
            'images.*.max' => 'Maximum size for external Images is 10MB.',
            'cover_image.mimes' => 'Only jpg, jpeg, and png are allowed.',
            'cover_image.max' => 'Maximum size for Cover Image is 5MB.',
        ]);
        
        Menu::create([
            'name'        => ucwords($request['name']),
            'description' => ucfirst($request['description']),
            'price'       => $request['price'],
            'stock'       => intval($request['stock']),
            'category'    => $request->category
        ]);

        if (Menu_cover::all()->count() == 0) {
            $lastImage = 1;
        } else {
            $lastImage = Menu_cover::orderBy('id', 'desc')->first()->id + 1;
        }

        $strRandom5 = Str::random(5);
        $image1Ext = $request->file('cover_image')->getClientOriginalExtension();
        $getLastId = Menu::withTrashed()->orderBy('id', 'desc')->first()->id;
        $image1Name = 'image-cover-' . $strRandom5 . $getLastId . '.' . $image1Ext;

        Menu_cover::create([
            'name' => $image1Name,
            'menu_id' => $getLastId
        ]);
           
        $dir = 'public/menuImages';
        // Upload
        $request->file('cover_image')->storeAs($dir, $image1Name);
            
        // Other images
        if ($request->hasFile('images') == true) {
            foreach ($request->file('images') as $image) {
                if (Menu_image::all()->count() == 0) {
                    $imgOtherLastId = 1;
                } else {
                    $imgOtherLastId = Menu_image::orderBy('id', 'desc')->first()->id + 1;
                }
                $strRandom10 = Str::random(10);
                $imgOtherFileName = 'image-' . $strRandom10 . $imgOtherLastId . '.' . $image->getClientOriginalExtension();

                Menu_image::create([
                    'name' => $imgOtherFileName,
                    'menu_id' => $getLastId
                ]);

                // Upload
                $image->storeAs($dir, $imgOtherFileName);
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
            // 'img'         => 'string|required',
            'stock'       => 'numeric|min:1|required',
        ]);

        Menu::where('id', $id)->update([
            'name'        => ucwords($request['name']),
            'description' => ucfirst($request['description']),
            'price'       => $request['price'],
            // 'img'         => $request['img'],
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

        $orders = Order::where('menu_id', $id)->get();
        foreach ($orders as $order) {
            Notification::create([
                'user_id' => $order->user_id,
                'message' => 'Your order <b>' . $menu->name . '</b> is unavailable right now.',
                'status' => 0
            ]);
        }

        foreach ($menu->images as $image) {
            if (Storage::disk('local')->exists('public/menuImages/' . $image->name) == true) {
                $moveImage = Storage::move('public/menuImages/' . $image->name, 'menuImages/' . $image->name);
            }
        }

        if (Storage::disk('local')->exists('public/menuImages/' . $menu->cover->name) == true) {
            $moveImage = Storage::move('public/menuImages/' . $menu->cover->name, 'menuImages/' . $menu->cover->name);
        }
        
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
            if (Storage::disk('local')->exists('menuImages/' . $image->name) == true) {
                $restoreImage = Storage::move('menuImages/' . $image->name, 'public/menuImages/' . $image->name);
            }
        }

        if (Storage::disk('local')->exists('menuImages/' . $menu->cover->name) == true) {
            $restoreImage = Storage::move('menuImages/' . $menu->cover->name, 'public/menuImages/' . $menu->cover->name);
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
            if (Storage::disk('local')->exists('menuImages/' . $image->name) == true) {
                $imgUrl = Storage::disk('local')->delete('menuImages/' . $image->name);
            }
        }

        if (Storage::disk('local')->exists('menuImages/' . $menu->cover->name) == true) {
            $imgUrl = Storage::disk('local')->delete('menuImages/' . $menu->cover->name);
        }

        Menu_image::where('menu_id', $id)->forceDelete();
        Menu_cover::where('menu_id', $id)->delete();
        $deleteMenu = $menu->forceDelete();
        return redirect()->route('menus.deleted')->with('status', 'Menu Deleted Permanent !');
    }

    public function editCover(Menu $menu)
    {
        return view('menus.edit.edit-cover', ['menu' => $menu]);
    }

    public function updateCover(Request $request, Menu $menu)
    {
        $request->validate([
            'newCover' => 'required|mimes:jpg,jpeg,png|max:5120'
        ],
        [
            'newCover.max' => 'Maximum file size is 5MB',
            'newCover.mimes' => 'Only accepting JPG, JPEG, and PNG formats'
        ]);

        $cover = $menu->cover->name;
        if (Storage::disk('local')->exists('public/menuImages/' . $cover) == true) {
            Storage::disk('local')->delete('public/menuImages/' . $cover);
        }
        
        // Upload
        $request->file('newCover')->storeAs('public/menuImages', $cover);
        return redirect()->route('menus.edit', $menu)->with('status-success', 'Cover updated !');
    }

    public function deleteCover(Menu $menu)
    {
        // return $menu;
        if (Storage::disk('local')->exists('public/menuImages/' . $menu->cover->name) == true) {
            Storage::disk('local')->delete('public/menuImages/' . $menu->cover->name);
        } else {
            return redirect()->route('menus.editCover', $menu);
        }
        return redirect()->route('menus.edit', $menu)->with('status-success', 'Cover deleted !');
    }

    public function editImage(Menu $menu, Menu_image $image)
    {
        return view('menus.edit.edit-image', ['menu' => $menu, 'image' => $image]);
    }

    public function updateImage(Request $request, Menu $menu, Menu_image $image)
    {
        $request->validate([
            'newImage' => 'required|mimes:jpg,jpeg,png|max:5120'
        ],
        [
            'newImage.max' => 'Maximum file size is 5MB',
            'newImage.mimes' => 'Only accepting JPG, JPEG, and PNG formats'
        ]);

        $image = $image->name;
        if (Storage::disk('local')->exists('public/menuImages/' . $image) == true) {
            Storage::disk('local')->delete('public/menuImages/' . $image);
        }
        
        // Upload
        $request->file('newImage')->storeAs('public/menuImages', $image);
        return redirect()->route('menus.edit', $menu)->with('status-success', 'Image updated !');
    }

    public function deleteImage(Menu $menu, Menu_image $image)
    {
        if (Storage::disk('local')->exists('public/menuImages/' . $image->name) == true) {
            Storage::disk('local')->delete('public/menuImages/' . $image->name);
        }
        $image->delete();
        return redirect()->route('menus.edit', $menu)->with('status-success', 'Image deleted !');
    }

    public function addImages(Menu $menu, Request $request)
    {
        $request->validate([
            'newImages.*' => 'required|mimes:jpg,jpeg,png|max:10120'
        ],[
            'newImages.*.mimes' => 'Only jpg, jpeg, and png are allowed.',
            'newImages.*.max' => 'Maximum size is 10MB.',
            'newImages.*.required' => 'File is required.'
        ]);
        if ($request->hasFile('newImages') == true) {
            foreach ($request->file('newImages') as $image) {
                if (Menu_image::all()->count() == 0) {
                    $imgNew = 1;
                } else {
                    $imgNew = Menu_image::orderBy('id', 'desc')->first()->id + 1;
                }
                $fileName = 'image-' . $imgNew . '.' . $image->getClientOriginalExtension();

                Menu_image::create([
                    'name' => $fileName,
                    'menu_id' => $menu->id
                ]);

                // Upload
                $image->storeAs('public/menuimages', $fileName);
            }
        }

        return redirect()->route('menus.edit', $menu)->with('status-success', 'Images uploaded !');
    }

    public function getCover($cover)
    {
        if (Storage::disk('local')->exists('menuImages/'. $cover) == true) {
            $getCover = Storage::get('menuImages/' . $cover);
            return $getCover;
        } else {
            return abort(404);
        }
    }

    public function foods($category)
    {
        $menus = Menu::where('category', $category)->paginate(10);
        return view('menus.index', ['menus' => $menus]);
    }
}
