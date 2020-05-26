@extends('layouts.app')

@section('title')
    | Invoice
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-success text-center">INVOICE</h3>
                    <div class="d-flex justify-content-between">
                        <span>
                            <span class="font-weight-bold">Payment :</span> <span class="badge badge-pill badge-success">Success</span>
                        </span>
                        <span class="text-muted">{{ $time->diffForHumans() }}</span>
                    </div>
                    @if (Auth::user()->level == 'Admin' or Auth::user()->level == 'Owner')
                    <br>
                    <span class="font-weight-bold">Username :</span> <span class="badge badge-pill badge-orange">{{ '@' . $invoices->first()->user->username }}</span>
                    @endif
                    <span class="font-weight-bold">Date :</span> <span class="text-orange">{{ $invoices->created_at->format('d M Y, H:i') }}</span>
                    <div class="d-flex mb-2" style="margin-left: -2px;">
                        <span class="material-icons text-muted mr-1">receipt</span>
                        <span class="text-muted">{{ $code }}</span>
                    </div>
                    <div class="row">
                        @foreach ($invoices->invoices as $invoice)
                        <div class="col-12">
                            <div class="card border-0 shadow-sm mb-2">
                                <div class="card-body">
                                    <p class="m-0 font-weight-bold">{{ $invoice->menu }}</p>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">Price : <span class="text-success">Rp {{ number_format($invoice->total / $invoice->quantity,0 ,0, '.') }}</span></small>
                                        <small class="text-muted">Quantity : <span class="text-success">{{ $invoice->quantity }}</span></small>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <p class="font-weight-bold text-muted m-0">Total : <span class="text-orange">Rp {{ number_format($invoice->total,0 ,0, '.') }}</span></p>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-pill badge-orange">{{ $invoice->status }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection