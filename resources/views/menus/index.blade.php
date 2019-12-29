@extends('layouts.app')

@section('title', '| Menus')

@section('content')
<div class="container">
    <div class="card-group">
        @foreach ($menus as $menu)
        <div class="col-12 col-md-3 py-0 py-md-2">
            <div class="card mb-3 h-100 shadow-sm">
                <img src="{{ $menu->img }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('menus.show', $menu->id) }}" class="text-decoration-none text-success">{{ $menu->name }}</a></h5>
                    <p class="card-text">{{ Str::limit($menu->description, 50) }}</p>
                    {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection