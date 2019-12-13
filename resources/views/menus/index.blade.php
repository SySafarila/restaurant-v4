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
        @foreach ($menus as $menu)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ $menu->img }}" alt="Failed" class="card-img-top">
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