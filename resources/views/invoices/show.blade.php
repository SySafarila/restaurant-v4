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
                    <div class="row">
                        <div class="col">
                            <span class="font-weight-bold">Status :</span> <span class="badge badge-pill badge-success">Success</span>
                            @if (Auth::user()->level == 'Admin' or Auth::user()->level == 'Owner')
                            <br>
                            <span class="font-weight-bold">Username :</span> <span class="badge badge-pill badge-orange">{{ '@' . $invoices->first()->user->username }}</span>
                            @endif
                        </div>
                        <div class="col">
                            <span class="font-weight-bold">Date :</span> <span class="text-orange">{{ $invoices->created_at->format('d M Y, H:i') }}</span> <p><span class="font-weight-bold">{{ $time->diffForHumans() }}</span></p>
                        </div>
                    </div>
                    <p class="text-muted" title="{{ $code }}">Code : {{ Str::limit($code, 30, ' . . .') }}</p>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices->invoices as $invoice)
                                <tr>
                                    <td>
                                        {{ $invoice->menu }} 
                                        <span class="badge badge-pill badge-success align-middle">{{ $invoice->quantity }}</span>
                                        <br>
                                        <span class="badge badge-pill badge-orange align-middle">{{ $invoice->status }}</span>
                                    </td>
                                    <td class="text-center text-success">Rp. {{ number_format($invoice->total,0 ,0, '.') }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="text-right font-weight-bold text-success">Total </td>
                                    <td class="text-center font-weight-bold text-orange">Rp. {{ number_format($invoices->invoices->sum('total'),0 ,0, '.') }}</td>
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