<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'customer', 'checkUserStatus']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $number = 1;
        $user   = Auth::user();
        // $orders = User::find($user)->orders->where('status', 'Pending');
        $orders = Order::where('user_id', $user->id)->latest()->get()->whereNotIn('status', 'Success');

        // return $orders->first()->menu->name;

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
        
        $check = Order::where([
            'user_id' => $user_id,
            'menu_id' => $menu_id,
            'status'  => 'Pending'
        ]);

        // return $check->first('quantity')->quantity;
        // Conditionals
        if ($check->count() == 1) {
            Order::where([
                'user_id' => $user_id,
                'menu_id' => $menu_id,
                'status'  => 'Pending',
            ])->update([
                    'quantity' => Order::where([
                    'user_id'  => $user_id,
                    'menu_id'  => $menu_id,
                    'status'   => 'Pending',
                ])->first('quantity')->quantity + $request['quantity'],
                    'total'   => Order::where([
                    'user_id' => $user_id,
                    'menu_id' => $menu_id,
                    'status'  => 'Pending',
                ])->first('total')->total + $total,
            ]);
            return redirect()->route('menus.index')->with('status', 'Success added to current ');
        } else {
            Order::create([
                'user_id'  => $user_id,
                'menu_id'  => $menu_id,
                'quantity' => $quantity,
                'price'    => $price,
                'total'    => $total,
                'status'   => $status,
            ]);
            return redirect()->route('menus.index')->with('status', 'Success add a new ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('orders.index')->with('status_warning', 'Redirected');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user  = Auth::user()->id;
        $order = Order::where('id', $id)->where('user_id', $user)->where('status', 'Pending')->firstOrFail();

        // return $order;
        return view('orders.edit', ['order' => $order]);
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
        $validate = $request->validate([
            'menu'     => 'numeric|exists:menus,id|required',
            'quantity' => 'numeric|min:1|max:10000|required',
        ]);

        $menu_id = $request['menu'];
        $price = Menu::findOrFail($menu_id)->price;

        $edit = Order::where('id', $id)->update([
            'quantity' => $request['quantity'],
            'total'    => $price * $request['quantity'],
        ]);

        return redirect()->route('orders.index')->with('status', 'Order Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user   = Auth::user()->id;
        $orders = Order::where('user_id', $user)->where('status', 'Pending')->delete();

        return redirect()->route('orders.index')->with('status', 'Orders deleted');
    }

    public function destroyOne($id)
    {
        $user   = Auth::user()->id;
        $orders = Order::where('user_id', $user)->where('status', 'Pending')->where('id', $id)->delete();

        return redirect()->route('orders.index')->with('status', 'Order deleted');
    }

    public function redirect()
    {
        return redirect()->route('orders.index')->with('status_warning', 'Redirected');
    }
}
