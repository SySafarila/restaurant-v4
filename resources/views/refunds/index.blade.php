@extends('layouts.app')

@section('title')
    | Refunds
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4>Pending</h4>
                        <hr>
                        @foreach ($refunds->where('status', 'Pending') as $refund)
                            <div class="card mb-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <p class="m-0 font-weight-bold">{{ '@' . $refund->user->username }}</p>
                                            <p class="m-0 text-muted">{{ $refund->menu }}</p>
                                            <p class="m-0"><span class="text-success">Rp {{ number_format($refund->refund,0 ,0, '.') }}</span> <span class="text-muted">× {{ $refund->menu_quantity }}</span></p>
                                            <span class="badge badge-pill badge-orange">{{ $refund->status }}</span>
                                        </div>
                                        <div class="col d-flex align-items-center flex-row-reverse">
                                            <p class="m-0 text-muted text-right">{{ $refund->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($refunds->where('status', 'Pending')->count() == 0)
                            <span class="text-muted d-block text-center">Empty</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4>Success</h4>
                        <hr>
                        @foreach ($refunds->where('status', 'Success') as $refund)
                            <div class="card mb-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <p class="m-0 font-weight-bold">{{ '@' . $refund->user->username }}</p>
                                            <p class="m-0 text-muted">{{ $refund->menu }}</p>
                                            <p class="m-0"><span class="text-success">Rp {{ number_format($refund->refund,0 ,0, '.') }}</span> <span class="text-muted">× {{ $refund->menu_quantity }}</span></p>
                                            <span class="badge badge-pill badge-orange">{{ $refund->status }}</span>
                                        </div>
                                        <div class="col d-flex align-items-center flex-row-reverse">
                                            <p class="m-0 text-muted text-right">{{ $refund->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($refunds->where('status', 'Success')->count() == 0)
                            <span class="text-muted d-block text-center">Empty</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection