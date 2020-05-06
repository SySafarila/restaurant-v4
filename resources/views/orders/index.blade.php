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
            @forelse ($orders as $order)
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-5 col-md-3">
                                    <img src="{{ asset('storage/menuImages/' . $order->menu->cover->name) }}" class="show-image-other" alt="">
                                </div>
                                <div class="col pt-2 pl-0">
                                    <p class="card-title font-weight-bold m-0">{{ $order->menu->name }}</p>
                                    <span class="text-success">{{ $order->quantity }}</span> <span class="font-weight-bold">x</span> <span class="text-orange font-weight-bold">{{ number_format($order->menu->price, 0, 0, '.') }}</span>
                                    <br>
                                    @if ($order->menu->stock - $order->quantity < 0)
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
            @empty
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm border-danger">
                        <div class="card-body">
                            <p class="text-muted text-center m-0">EMPTY</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <span class="text-success">TOTAL</span> <span class="text-orange font-weight-bold">Rp {{ number_format($orders->sum('total'), 0, 0, '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection