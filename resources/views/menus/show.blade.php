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
        {{-- Breadcrumb --}}
        <div class="my-breadcrumb d-flex pb-3">
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-success">Dashboard</a>
            <span class="text-muted px-2">/</span>
            <a href="{{ route('menus.index') }}" class="text-decoration-none text-success">Menus</a>
            <span class="text-muted px-2">/</span>
            <span class="text-decoration-none text-orange">{{ $menu->name }}</span>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card mb-4 shadow">
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
                            <input type="number" name="quantity" id="quantity" class="rounded-pill form-control form-control-sm col @error('quantity') is-invalid @enderror" placeholder="Quantity" required @if($menu->stock <= 0) disabled @endif>
                            <button type="submit" id="shop" onclick="shopClick()" class="rounded-pill btn btn-sm btn-success ml-1 material-icons" @if($menu->stock <= 0) disabled @endif>add_shopping_cart</button>
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
        <div class="col-12 col-md-4">
            <h3 class="text-center">Other Menus</h3>
            @foreach ($menus as $menu)
                <div class="card mb-3 shadow">
                    <div class="card-body p-2">
                        <a href="{{ route('menus.show', $menu->id) }}" class="stretched-link"></a>
                        <div class="row no-gutters">
                            <div class="col-6">
                                <img src="{{ $menu->img }}" class="card-img border-0">
                            </div>
                            <div class="col ml-3">
                                <h5 class="font-weight-bold"><a href="{{ route('menus.show', $menu->id) }}" class="stretched-link text-success text-decoration-none">{{ $menu->name }}</a></h5>
                                <p class="text-orange m-0">Rp {{ number_format($menu->price,0 ,0, '.') }}</p>
                                <p class="m-0"><span class="badge badge-pill badge-orange">Stock {{ number_format($menu->stock,0 ,0, '.') }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function shopClick() {
        const quantity = document.getElementById('quantity').value;
        if (quantity == '') {
            console.log('null');
        } else {
            document.getElementById('shop').innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>';
        }
    }
</script>
@endsection