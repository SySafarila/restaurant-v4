@php
    $checkImage = Storage::disk('local')->exists('public/menuImages/' . $menu->cover->name);
    if ($checkImage == true) {
        $menuImage = asset('storage/menuImages/' . $menu->cover->name);
    } else {
        $menuImage = asset('image-not-found.png');
    }

    $no = 1;
@endphp
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
            <div class="container">
                <a href="{{ route('menus.index') }}" class="text-decoration-none text-success">Menus</a>
                <span class="text-muted px-2">/</span>
                <a href="{{ route('menus.category', ['category' => $menu->category]) }}" class="text-decoration-none text-success">{{ $menu->category }}</a>
                <span class="text-muted px-2">/</span>
                <span class="text-decoration-none text-orange text-break">{{ $menu->name }}</span>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card mb-4 shadow">
                {{-- Carousel --}}
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active" style="background-color: #38c172;"></li>
                        @foreach ($images as $item)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $no }}" style="background-color: #38c172;"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ $menuImage }}" class="d-block show-image" alt="...">
                        </div>
                        @foreach ($images as $image)
                            @php
                                if (Storage::disk('local')->exists('public/menuImages/' . $image->name) == true) {
                                    $carouselImage = asset('storage/menuImages/' . $image->name);
                                } else {
                                    $carouselImage = asset('image-not-found.png');
                                }
                                
                            @endphp
                        <div class="carousel-item">
                            <img src="{{ $carouselImage }}" class="d-block show-image" alt="...">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        {{-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> --}}
                        <span class="material-icons text-light bg-success rounded-pill">chevron_left</span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        {{-- <span class="carousel-control-next-icon" aria-hidden="true"></span> --}}
                        <span class="material-icons text-light bg-success rounded-pill">chevron_right</span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                {{-- Carousel --}}
                <div class="card-body">
                    <h5 class="card-title text-success font-weight-bold mb-1">{{ $menu->name }}</h5>
                    <div class="d-flex justify-content-between mb-1">
                        <h6 class="card-subtitle m-0 text-orange font-weight-bold">Rp {{ number_format($menu->price,0 ,0, '.') }}</h6>
                        <span class="badge badge-pill badge-success align-middle" style="white-space: pre;">Stock : {{ $menu->stock }}</span>
                    </div>
                    <hr>
                    <p class="card-text mb-0" style="white-space: pre-line;">{!! $menu->description !!}</p>
                    <p class="font-weight-bold">Category : <span class="badge badge-pill badge-dark align-middle">{{ $menu->category }}</span></p>
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
                    @if (Auth::user()->level == 'Customer')
                        <form action="{{ route('orders.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="menu" value="{{ $menu->id }}">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text order-button btn btn-success" onclick="orderMinus()">-</button>
                                </div>
                                <input type="number" class="form-control text-center bg-white" name="quantity" id="quantity" value="1" readonly>
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text order-button btn btn-success" onclick="orderPlus()">+</button>
                                </div>
                            </div>
                            <button type="submit" id="shop" onclick="shopClick()" class="rounded btn btn-block btn-orange material-icons rem-1" @if($menu->stock <= 0) disabled @endif>add_shopping_cart</button>
                        </form>
                    @endif
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    {{-- <form action="{{ route('orders.store') }}" method="post">
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
                    </form> --}}
                    @endif
                </div>
            </div>
        </div>
        @if ($menus->count() >= 1)
            <div class="col-12 col-md-4">
                <h3 class="text-center">Other Menus</h3>
                <hr>
                @foreach ($menus as $other)
                    @php
                        $checkImageOther = Storage::disk('local')->exists('public/menuImages/' . $other->cover->name);
                        if ($checkImageOther == true) {
                            $menuImageOther = asset('storage/menuImages/' . $other->cover->name);
                        } else {
                            $menuImageOther = asset('image-not-found.png');
                        }
                        
                    @endphp
                    <div class="card mb-3" style="max-width: 540px;">
                        <a href="{{ route('menus.show', $other->id) }}" class="stretched-link"></a>
                        <div class="row no-gutters">
                            <div class="col-4">
                                <img src="{{ $menuImageOther }}" class="show-image-other" alt="{{ $menuImageOther }}">
                            </div>
                            <div class="col-8">
                                <div class="card-body px-1 pb-0 pt-1">
                                <h6 class="card-title font-weight-bold menu-title-wrap">{{ $other->name }}</h6>
                                <h6 class="card-subtitle m-0 text-orange font-weight-bold">Rp {{ number_format($other->price,0 ,0, '.') }}</h6>
                                <span class="badge badge-pill badge-success align-middle" style="white-space: pre;">Stock : {{ $other->stock }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

@section('script')
<script>
    function shopClick() {
        const quantity = document.getElementById('quantity').value;
        if (quantity == '') {
            // console.log('null');
        } else {
            document.getElementById('shop').innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>';
        }
    }

    function orderPlus() {
        const quantity = document.getElementById('quantity');
        // console.log(parseInt(quantity.value) + 1);
        quantity.value = parseInt(quantity.value) + 1;
    }
    
    function orderMinus() {
        const quantity = document.getElementById('quantity');
        // if (quantity.value == 1) {
        //     console.log('nol');
        // } else {
        //     quantity.value = parseInt(quantity.value) - 1;
        // }
        if (quantity.value > 1) {
            quantity.value = parseInt(quantity.value) - 1;
        }
    }
</script>
@endsection