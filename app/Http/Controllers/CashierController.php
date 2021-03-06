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
use Illuminate\Support\Facades\Storage;
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
            $code_slug = 'INV-U-' . $order->user_id . '-' . $day . '-' . $month . '-' . $year . '-' . $lastCode;

            $menu = Menu::where('id', $order->menu_id)->first();

            if ($order->menu->stock == 0) {
                return ('Out of stock');
            }
            
            if ($menu->stock - $order->quantity < 0) {
                return ('quantity is not enough');
            }

            Menu::where('id', $order->menu_id)->update([
                'stock' => $menu->stock - $order->quantity
            ]);

            if ($menu->images->count() > 0) {
                $image = $menu->images->first()->name;
                if ($menu->stock - $order->quantity == 0) {
                    if (Storage::disk('local')->exists('public/menuImages/' . $image) == true) {
                        Storage::move('public/menuImages/' . $image, 'menuImages/' . $image);
                    }
                    Menu::where('id', $order->menu_id)->delete();
                }
            }

            Invoice::create([
                'user_id' => $order->user_id,
                'menu' => $order->menu->name,
                'quantity' => $order->quantity,
                'total' => $order->total,
                'invoice_code_id' => $lastCode,
                'code' => $code,
                'status' => 'Pending',
            ]);
            
            Order::where('id', $id)->delete();
        }

        Invoice_code::create([
            'user_id' => $order->user_id,
            'code' => $code,
            'code_slug' => $code_slug
        ]);

        Notification::create([
            'user_id' => $order->user_id,
            'message' => 'Your payment was successfully with code ' . '<b>' . $code . '</b>',
            'status' => 0
        ]);

        return redirect()->route('cashier.index')->with('status', 'Payment Success !');
    }
}
