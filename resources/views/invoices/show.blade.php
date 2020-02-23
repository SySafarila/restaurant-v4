@extends('layouts.app')

@section('title')
    | Invoice
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-success text-center">INVOICE</h3>
                    <p class="text-muted">{{ $unique }}</p>
                    <p class="text-muted">Date : {{ $invoices->first()->created_at }}</p>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->menu }} <span class="badge badge-pill badge-success align-middle">{{ $invoice->quantity }}</span></td>
                                    <td class="text-center">Rp. {{ number_format($invoice->total,0 ,0, '.') }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="text-right font-weight-bold text-success">Total : </td>
                                    <td class="text-center font-weight-bold text-orange">Rp. {{ number_format($invoices->sum('total'),0 ,0, '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection