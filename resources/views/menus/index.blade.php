@extends('layouts.app')

@section('title', '| Menus')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('status'))
            <div class="alert alert-warning" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (Auth::user()->level == 'Admin')
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Add Menus</h5>
                        <form action="" method="post">
                            <input type="text" name="" id="" class="form-control form-control-sm mb-1" placeholder="Name">
                            <input type="text" name="" id="" class="form-control form-control-sm mb-1" placeholder="Description">
                            <input type="text" name="" id="" class="form-control form-control-sm mb-1" placeholder="Price">
                            <input type="file" name="" id="" class="form-control-file mb-1">
                            <button type="submit" class="btn btn-sm btn-success btn-block">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @foreach ($menus as $menu)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                {{-- <img src="{{ $menu->img }}" alt="Failed" class="card-img-top"> --}}
                <div class="card-body">
                    <h5 class="card-title">{{ $menu->name }}</h5>
                    <p class="card-text">{{ $menu->description }}</p>
                    <p class="card-text">{{ 'Rp' . $menu->price }} | {{ 'Stock : ' . $menu->stock}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection