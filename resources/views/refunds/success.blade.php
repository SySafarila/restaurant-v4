@extends('layouts.app')

@section('title')
    | Refunds - Success
@endsection

@section('content')
    <div class="container">
        <x-alert />
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm" id="refunds-pending-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="m-0">Success</h4>
                            <span class="material-icons text-muted" id="refunds-pending-more-vert">more_vert</span>
                        </div>
                        <hr>
                        @foreach ($refunds as $refund)
                            <div class="card mb-3 shadow-sm border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <p class="m-0 font-weight-bold">{{ '@' . $refund->user->username }}</p>
                                            <p class="m-0 text-muted">{{ $refund->menu }}</p>
                                            <p class="m-0 text-muted">{{ $refund->invoice_code }}</p>
                                            <p class="m-0"><span class="text-success">Rp {{ number_format($refund->refund,0 ,0, '.') }}</span> <span class="text-muted">× {{ $refund->menu_quantity }}</span></p>
                                            <span class="badge badge-pill badge-success">{{ $refund->status }}</span>
                                        </div>
                                        <div class="col d-flex align-items-center flex-row-reverse">
                                            <p class="m-0 text-muted text-right">{{ $refund->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($refunds->count() == 0)
                            <span class="text-muted d-block text-center">Empty</span>
                        @endif
                        <div class="d-flex justify-content-center">
                            {{ $refunds->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection