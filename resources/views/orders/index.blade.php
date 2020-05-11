@extends('layouts.app')

@section('title')
    | Orders
@endsection

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="row justify-content-center">
                <div class="col-md-6">
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
                <div class="col-md-6">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('status_warning') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        @foreach ($orders as $order)
        @php
            $checkImage = 'public/menuImages/' . $order->menu->cover->name;
            if (Storage::disk('local')->exists($checkImage) == true) {
                $image = asset('storage/menuImages/' . $order->menu->cover->name);
            } else {
                $image = asset('image-not-found.png');
            }
            
        @endphp
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-5 col-md-3 pr-1">
                                <img src="{{ $image }}" class="show-image-other" alt="">
                            </div>
                            <div class="col-7 col-md-8 pt-0 pl-0">
                                <p class="card-title font-weight-bold m-0"><a href="{{ route('menus.show', $order->menu_id) }}" class="text-decoration-none text-dark">{{ Str::limit($order->menu->name, 40, '...') }}</a></p>
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
        </div>
        @endforeach
        @if ($orders->count() == 0)
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <span class="text-danger">Empty</span>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <span class="text-success">TOTAL</span> <span class="text-orange font-weight-bold">Rp {{ number_format($orders->sum('total'), 0, 0, '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection