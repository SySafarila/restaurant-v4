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
                            <span class="font-weight-bold">Date :</span> <span class="text-orange">{{ $invoices->created_at->format('d M Y, H:i') }}</span> <p><span class="font-weight-bold">It's {{ $time->diffForHumans() }}</span></p>
                        </div>
                    </div>
                    <p class="text-muted" title="{{ $code }}">Code : {{ Str::limit($code, 30, ' . . .') }}</p>
                    {{-- <button type="button" class="btn btn-sm btn-success mb-2" data-toggle="modal" data-target="#modalUnique">Show Unique Code</button> --}}
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
                                    <td>{{ $invoice->menu }} <span class="badge badge-pill badge-success align-middle">{{ $invoice->quantity }}</span></td>
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
{{-- Modal --}}
{{-- <div class="modal fade" id="modalUnique" tabindex="-1" role="dialog" aria-labelledby="modalUniqueTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUniqueTitle">Unique Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="text-center">CODE</h3>
                <div class="card border-0 shadow mb-2">
                    <div class="card-body">
                        <p class="m-0 text-center">
                            {{ $invoices->first()->code }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}
@endsection