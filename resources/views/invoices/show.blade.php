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
                    <h3 class="card-title">Date : {{ $invoice->created_at }}</h3>
                    <p>{!! $invoice->menu !!}</p>
                    <p>Total : {{ $invoice->total }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection