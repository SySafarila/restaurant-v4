@extends('layouts.app')

@section('title')
    | Refunds
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @foreach ($user->refunds->where('status', 'Pending') as $refund)
                    <div class="card mb-3">
                        <div class="card-body">
                            <p class="font-weight-bold m-0">{{ '@' . $refund->user->username }}</p>
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">Menu Price : <span class="text-success">{{ $refund->refund / $refund->menu_quantity }}</span></small>
                                <small class="text-muted">Menu Quantity : <span class="text-success">{{ $refund->menu_quantity }}</span></small>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p class="font-weight-bold m-0 text-muted">Total Refund : <span class="text-orange">{{ $refund->refund }}</span></p>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('refunds.update', $refund->id) }}" class="badge badge-pill badge-success" onclick="event.preventDefault();document.getElementById('setSuccess').submit();">Set to Success</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('refunds.update', $refund->id) }}" method="post" id="setSuccess">
                        @csrf
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection