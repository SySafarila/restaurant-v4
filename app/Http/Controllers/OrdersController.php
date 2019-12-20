<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // Validation
        $validation = $request->validate([
            'menu' => 'numeric|exists:menus,id',
            'quantity' => 'numeric|min:1|max:10000'
        ]);

        // Parameter for input to database
        $user_id = Auth::user()->id;
        $menu_id = $request['menu'];
        $quantity = $request['quantity'];
        $price = Menu::findOrFail($menu_id)->price;
        $total = $price * $quantity;

        // Input to database
        $order = Order::create([
            'user_id' => $user_id,
            'menu_id' => $menu_id,
            'quantity' => $quantity,
            'price' => $price,
            'total' => $total,
        ]);

        return ('added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
