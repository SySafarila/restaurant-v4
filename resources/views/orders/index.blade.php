@extends('layouts.app')

@section('title')
    | Orders
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
            @foreach ($orders as $order)
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ $order->menu->img }}" class="card-img shadow-sm" alt="">
                            </div>
                            <div class="col">
                                <p class="card-title font-weight-bold m-0">{{ $order->menu->name }}</p>
                                <span class="text-success">{{ $order->quantity }}</span> <span class="font-weight-bold">x</span> <span class="text-orange font-weight-bold">{{ number_format($order->menu->price, 0, 0, '.') }}</span>
                                    <br>
                                @if ($order->menu->stock - $order->quantity <= 0)
                                <span class="badge badge-warning algn-middle">Order Is Too Much</span>
                                @endif
                                @if ($order->menu->stock == 0)
                                    <span class="badge badge-warning algn-middle">Out of stock</span>
                                @else
                                    <span class="badge badge-success align-middle"><a href="{{ route('orders.edit', $order->id) }}" class="text-white text-decoration-none">Edit</a></span>
                                @endif
                                <a href="{{ route('orders.destroyOne', $order->id) }}" class="badge badge-danger align-middle" onclick="event.preventDefault();document.getElementById('destroyOne').submit();">Delete</a>
                                <form id="destroyOne" action="{{ route('orders.destroyOne', $order->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection