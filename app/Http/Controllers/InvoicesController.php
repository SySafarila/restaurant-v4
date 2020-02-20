<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Menu;
use App\Order;
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
            $invoices = Invoice::all();

            return view('invoices.index', ['invoices' => $invoices, 'nomor' => $nomor]);
        } else {
            $invoices = Invoice::where('user_id', $user->id)->latest()->paginate(10);

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
        $random = Str::random(60);

        foreach ($request->orderId as $id) {
            $order = Order::where('id', $id)->first();
            // echo $order;

            $min = Menu::where('id', $order->menu_id)->first();
            // echo $min->stock;
            $menu = Menu::where('id', $order->menu_id)->update([
                'stock' => $min->stock - $order->quantity
            ]);

            $invoice = Invoice::create([
                'user_id' => $order->user_id,
                'menu' => $order->menu->name,
                'quantity' => $order->quantity,
                'total' => $random
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user()->id;
        $invoice = Invoice::where(['user_id' => $user, 'id' => $id])->first();
        // dd($invoice);

        // return $invoice;
        return view('invoices.show', ['invoice' => $invoice]);
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
