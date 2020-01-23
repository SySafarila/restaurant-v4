@extends('layouts.app')

@section('title', '| Menus')

@section('content')
    <div class="container">
        <div class="row px-2 justify-content-center">
            @foreach ($menus as $menu)
                <div class="col-6 px-1 col-md-2 mb-2">
                    <div class="card h-100 shadow-sm">
                        <div style="background-image: url('{{ $menu->img }}'); height:140px; width:100%; background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                        <div class="card-body p-2">
                            <h6 class="card-title"><a href="{{ route('menus.show', $menu->id) }}" class="stretched-link text-decoration-none text-success font-weight-bold">{{ $menu->name }}</a></h6>
                            <h6 class="card-subtitle text-orange font-weight-bold">Rp {{ number_format($menu->price,0 ,0, '.') }}</h6>
                            {{-- <p class="card-text">{{ Str::limit($menu->description, 50) }}</p> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection