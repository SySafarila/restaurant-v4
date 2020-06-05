@extends('layouts.app')

@section('title')
    | Refunds
@endsection

@section('content')
    <div class="container">
        <x-alert />
        <div class="row justify-content-center">
            <div class="col-6 mb-3 pr-2 pr-md-3">
                <div class="card bg-success text-light shadow-sm border-0">
                    <div class="card-body">
                        <a href="{{ route('refunds.success') }}" class="stretched-link"></a>
                        <div class="d-flex justify-content-between">
                            <h4 class="m-0">Success</h4>
                            <h4 class="m-0 font-weight-bold">{{ $refunds->where('status', 'Success')->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-3 pl-2 pl-md-3">
                <div class="card bg-danger text-light shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="m-0">Pending</h4>
                            <h4 class="m-0 font-weight-bold">{{ $refunds->where('status', 'Pending')->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4>Search</h4>
                        <hr>
                        <form action="{{ route('refunds.search') }}" method="get">
                            <input type="text" name="username" class="form-control">
                            <button type="submit" class="btn btn-success mt-2">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm" id="refunds-pending-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="m-0">Pending</h4>
                            <span class="material-icons text-muted" id="refunds-pending-more-vert">more_vert</span>
                        </div>
                        <hr>
                        @foreach ($refunds->where('status', 'Pending') as $refund)
                            <div class="card mb-3 shadow-sm border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <p class="m-0 font-weight-bold">{{ '@' . $refund->user->username }}</p>
                                            <p class="m-0 text-muted">{{ $refund->menu }}</p>
                                            <p class="m-0 text-muted">{{ $refund->invoice_code }}</p>
                                            <p class="m-0"><span class="text-success">Rp {{ number_format($refund->refund,0 ,0, '.') }}</span> <span class="text-muted">× {{ $refund->menu_quantity }}</span></p>
                                            <span class="badge badge-pill badge-orange">{{ $refund->status }}</span>
                                            <span class="text-muted"> | </span>
                                            <a href="{{ route('refunds.update', $refund->id) }}" class="badge badge-pill badge-success" onclick="event.preventDefault();document.getElementById('setSuccess').submit();">Set to Success</a>
                                        </div>
                                        <div class="col d-flex align-items-center flex-row-reverse">
                                            <p class="m-0 text-muted text-right">{{ $refund->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('refunds.update', $refund->id) }}" method="post" id="setSuccess">
                                @csrf
                            </form>
                        @endforeach
                        @if ($refunds->where('status', 'Pending')->count() == 0)
                            <span class="text-muted d-block text-center">Empty</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection