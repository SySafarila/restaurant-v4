@extends('layouts.app')

@section('title')
    | Invoice
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $invoice->created_at }}</h3>
                    <p>{{ $invoice->menu }}</p>
                    <p>{{ $invoice->total }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection