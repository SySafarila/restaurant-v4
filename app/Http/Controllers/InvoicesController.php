<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $validation = $request->validate([
            'user_id' => 'required|numeric',
            'menus'   => 'required',
            'total'   => 'required|numeric'
        ]);
        
        $menu = implode($request->menus);
        
        $invoice = Invoice::create([
            'user_id'  => $request->user_id,
            'menu'     => $menu,
            'quantity' => 123,
            'total'    => $request->total
        ]);

        $deleteOrders = Order::where([
            'user_id' => $request->user_id,
            'status'  => 'Pending'
        ])->delete();

        return redirect()->route('users.index')->with('status', 'Payment Success !');
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
