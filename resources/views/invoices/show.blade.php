@extends('layouts.app')

@section('title')
    | Invoice
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Invoice : {{ $unique }}</h3>
                    @foreach ($invoices as $invoice)
                    <p>{!! $invoice->menu !!} qty : {{ $invoice->quantity }}</p>
                    <p>Total : {{ $invoice->total }}</p>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection