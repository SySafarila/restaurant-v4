<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Invoice_code;
use App\Menu;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nomor = 1;
        $user = Auth::user();
        if ($user->level == 'Admin') {
            $invoices = Invoice_code::paginate(20);

            return view('invoices.index', ['invoices' => $invoices, 'nomor' => $nomor]);
        } else {
            $invoices = Invoice_code::where('user_id', $user->id)->paginate(10);
            // return $invoices;

            return view('invoices.index', ['invoices' => $invoices, 'nomor' => $nomor]);
        }
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
        $random = Str::random(4);

        $lastCode = Invoice_code::latest()->first();
        if ($lastCode == null) {
            $lastCode = 1;
        } else {
            $lastCode = $lastCode->id + 1;
        }
        // return $checkLastCode;

        // Generate code
        $time = Carbon::now();
        $day = $time->day;
        $month = $time->month;
        $year = $time->year;
        $userId = $request->user()->id;

        $code = 'INV/U-' . $userId . '/' . $day . '/' . $month . '/' . $year . '/' . $lastCode;
        // return $lastCode . '|' . $code;
        

        foreach ($request->orderId as $id) {
            $order = Order::where('id', $id)->first();
            // echo $order;

            $min = Menu::where('id', $order->menu_id)->first();
            // echo $min->stock;

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
                // Order::where('menu_id', $order->menu_id)->delete();
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

        return ('sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice_code $invoice_code)
    {
        $auth = Auth::user();
        $invoices = $invoice_code;
        $code = $invoice_code->code;
        
        if ($auth->id == $invoice_code->user_id or $auth->level == 'Admin') {
            return view('invoices.show', ['invoices' => $invoices, 'code' => $code]);
        } else {
            return abort(404);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
