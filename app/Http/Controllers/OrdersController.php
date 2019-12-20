<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Order;
use App\User;
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
        $number = 1;
        $user   = Auth::user()->id;
        $orders = User::find($user)->orders->where('status', 'Pending');

        // return $orders;


        return view('orders.index', ['number' => $number, 'orders' => $orders]);
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
            'menu'     => 'numeric|exists:menus,id|required',
            'quantity' => 'numeric|min:1|max:10000|required',
        ]);

        // Parameter for input to database
        $user_id  = Auth::user()->id;
        $menu_id  = $request['menu'];
        $quantity = $request['quantity'];
        $price    = Menu::findOrFail($menu_id)->price;
        $total    = $price * $quantity;
        $status   = 'Pending';

        // Input to database
        $order = Order::create([
            'user_id'  => $user_id,
            'menu_id'  => $menu_id,
            'quantity' => $quantity,
            'price'    => $price,
            'total'    => $total,
            'status'   => $status,
        ]);

        return redirect()->route('menus.index')->with('status', 'Added to Orders');
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
