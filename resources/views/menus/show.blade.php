@extends('layouts.app')

@section('title', '| Menus')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card mb-4 shadow-sm">
                <img src="{{ $menu->img }}" alt="{{ $menu->name }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-success">{{ $menu->name }}</h5>
                    <p class="card-text">{{ $menu->description }}</p>
                    <p class="card-text">{{ 'Rp ' . number_format($menu->price) }} | {{ 'Stock : ' . $menu->stock}}</p>
                    @if (Auth::user()->level == 'Admin')
                        <div class="d-flex justify-content-between">
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            {{-- <a href="{{ route('menus.destroy', $menu->id) }}" class="btn btn-sm btn-danger">Delete</a> --}}
                            <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-success">Edit</a>
                        </div>
                    @else
                    <form action="{{ route('orders.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="menu" value="{{ $menu->id }}">
                        <div class="row px-3">
                            <input type="number" name="quantity" class="form-control form-control-sm col @error('quantity') is-invalid @enderror" placeholder="Quantity">
                            <button type="submit" class="btn btn-sm btn-success ml-1">Order</button>
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 d-sm-none d-none d-md-block">
            <ul class="list-group">
                <li class="list-group-item bg-success text-white">List Orders <span class="float-right mt-1 badge badge-pill align-middle badge-light">{{ Auth::user()->orders->count() }}</span></li>
                @if (Auth::user()->orders->count() < 1)
                <li class="list-group-item text-center">Empty</li>
                @else
                    @foreach (Auth::user()->orders as $order)
                    <li class="list-group-item">{{ $order->menu->name }} <span class="badge badge-pill align-middle badge-success">{{ $order->quantity }}</span></li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
@endsection