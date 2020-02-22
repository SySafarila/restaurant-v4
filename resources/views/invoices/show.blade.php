@extends('layouts.app')

@section('title')
    | Invoice
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-success">Invoice : {{ $unique }}</h5>
                    @foreach ($invoices as $invoice)
                    <p>{!! $invoice->menu !!} qty : {{ $invoice->quantity }}</p>
                @endforeach
                    <p>Total : {{ $invoices->sum('total') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection