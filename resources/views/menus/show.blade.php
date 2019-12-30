@extends('layouts.app')

@section('title')
    | {{ $menu->name }}
@endsection

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
            <div class="my-breadcrumb d-flex pb-3">
                <a href="{{ route('menus.index') }}" class="text-decoration-none text-success">Menus</a>
                <span class="material-icons text-muted pt-1 px-2" style="font-size:15px;">label_important</span>
                <p class="text-muted m-0">{{ $menu->name }}</p>
            </div>
            <div class="card mb-4 shadow-sm">
                <img src="{{ $menu->img }}" alt="{{ $menu->name }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-success font-weight-bold">{{ $menu->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-orange font-weight-bold">Rp {{ number_format($menu->price,0 ,0, '.') }} | {{ $menu->status }} : {{ $menu->stock }}</h6>
                    <p class="card-text">{!! nl2br(e($menu->description)) !!}</p>
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
                            <input type="number" name="quantity" class="rounded-pill form-control form-control-sm col @error('quantity') is-invalid @enderror" placeholder="Quantity" required>
                            <button type="submit" class="rounded-pill btn btn-sm btn-success ml-1 material-icons">add_shopping_cart</button>
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
    </div>
</div>
@endsection