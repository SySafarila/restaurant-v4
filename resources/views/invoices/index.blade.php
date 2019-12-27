@extends('layouts.app')

@section('title')
    | Invoices
@endsection

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="row justify-content-center">
                <div class="col-md-9 col-sm-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        @if (session('status_warning'))
            <div class="row justify-content-center">
                <div class="col-md-9 col-sm-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('status_warning') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-9 col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered shadow-sm">
                        <thead>
                            <tr>
                                <th colspan="5" class="text-center">Invoices</th>
                            </tr>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-left" style="min-width:160px;">Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td class="align-middle text-center">{{ $number++ }}</td>
                                    <td class="align-middle">{{ $invoice->menu->name }} @if($invoice->status == 'Cooking') <span class="badge badge-warning">{{ $invoice->status }}</span>@else <span class="badge badge-success">{{ $invoice->status }}</span> @endif</td>
                                    <td class="align-middle text-center">{{ $invoice->quantity }}</td>
                                    <td class="align-middle text-center">{{ number_format($invoice->price) }}</td>
                                    <td class="align-middle text-center font-weight-bold text-success">{{ number_format($invoice->total) }}</td>
                                </tr>
                            @endforeach
                            @if (count($invoices) < 1)
                            <tr>
                                <th class="align-middle text-center text-danger" colspan="5">Invoices Is Empty</th>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection