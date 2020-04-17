<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return view('menus.index', ['menus' => $menus, 'number' => $number]);
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
            'img'         => 'string|required',
            'stock'       => 'numeric|digits_between:1,9999|required',
            'status'      => 'in:Available,Unavailable|required'
        ]);

        Menu::create([
            'name'        => ucwords($request['name']),
            'description' => ucwords($request['description']),
            'price'       => $request['price'],
            'img'         => $request['img'],
            'stock'       => intval($request['stock']),
            'status'      => ucwords($request['status'])
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
        $menus = Menu::whereNotIn('id', [$id])->inRandomOrder()->paginate(4);

        return view('menus.show', ['menu' => $menu, 'menus' => $menus]);
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
            'status'      => 'in:Available,Unavailable|required'
        ]);

        Menu::where('id', $id)->update([
            'name'        => ucwords($request['name']),
            'description' => ucwords($request['description']),
            'price'       => $request['price'],
            'img'         => $request['img'],
            'stock'       => intval($request['stock']),
            'status'      => ucwords($request['status'])
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

        $onlyTrash = Menu::onlyTrashed()->get();

        if ($onlyTrash->count() == 0) {
            return redirect()->route('menus.index')->with('status', 'All Restored !');
        }

        return redirect()->route('menus.deleted')->with('status', 'Menus Restored !');
    }

    public function search(Request $request)
    {
        $menus = Menu::where('name', 'like', '%' . $request->name . '%')->orderBy('name')->get();
        
        return $menus;
    }
}
