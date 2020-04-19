<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Invoice;
use App\Invoice_code;
use App\Menu;
use App\Notification;
use App\Order;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CashierController extends Controller
{
    public function __construct()
    {
        // Authenticated cashier access only
        $this->middleware(['auth', 'cashier', 'checkUserStatus']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cashier.search');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payment(User $user)
    {
        $user = $user;
        $number   = 1;

        return view('cashier.show', ['user' => $user, 'number' => $number]);
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

    public function search(Request $request)
    {
        $username = $request->username;
        $level = User::where('username', $username)->first()->level;

        if ($level == 'Customer') {
            return redirect()->route('cashier.payment', $request->username);
        } else {
            return abort(404);
        }        
    }

    public function confirmPayment(Request $request)
    {
        $random = Str::random(4);

        $lastCode = Invoice_code::latest()->first();
        if ($lastCode == null) {
            $lastCode = 1;
        } else {
            $lastCode = $lastCode->id + 1;
        }

        // Generate code
        $time = Carbon::now();
        $day = $time->day;
        $month = $time->month;
        $year = $time->year;        
        
        foreach ($request->orderId as $id) {
            $order = Order::where('id', $id)->first();

            $code = 'INV/U-' . $order->user_id . '/' . $day . '/' . $month . '/' . $year . '/' . $lastCode;

            $min = Menu::where('id', $order->menu_id)->first();

            if ($order->menu->stock == 0) {
                return ('Out of stock');
            }
            
            if ($min->stock - $order->quantity < 0) {
                return ('quantity is not enough');
            }

            $menu = Menu::where('id', $order->menu_id)->update([
                'stock' => $min->stock - $order->quantity
            ]);

            if ($min->stock - $order->quantity == 0) {
                Menu::where('id', $order->menu_id)->delete();
            }

            $invoice = Invoice::create([
                'user_id' => $order->user_id,
                'menu' => $order->menu->name,
                'quantity' => $order->quantity,
                'total' => $order->total,
                'invoice_code_id' => $lastCode,
                'code' => $code
            ]);

            
            $delete = Order::where('id', $id)->delete();
        }

        Invoice_code::create([
            'user_id' => $order->user_id,
            'code' => $code
        ]);

        Notification::create([
            'user_id' => $order->user_id,
            'message' => 'Your payment was successfully with code ' . '<b>' . $code . '</b>',
            'status' => 0
        ]);

        return redirect()->route('cashier.index')->with('status', 'Payment Success !');
    }
}
