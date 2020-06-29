@extends('layouts.app')

@section('title', '| Menus')

@section('content')
    <div class="container">
        @if (session('status'))
        {{-- <div class=> --}}
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }} <a href="{{ route('orders.index') }}" class="alert-link text-decoration-none">Orders</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- </div> --}}
            @endif
        @if ($menus->count() == 0)
            <div class="row justify-content-center">
                <h2>Empty</h2>
            </div>
        @else
            <div class="row px-2 justify-content-center">
                @foreach ($menus as $menu)
                    @php
                        $checkImage = Storage::disk('local')->exists('public/menuImages/' . $menu->cover->name);
                        if ($checkImage == true) {
                            $image = asset('storage/menuImages/' . $menu->cover->name);
                        } else {
                            $image = asset('image-not-found.png');
                        }
                    @endphp
                    <div class="col-6 px-1 col-md-3 col-lg-2 mb-2">
                        <div class="card h-100 shadow-sm" id="{{ $menu->id }}">
                            <img src="{{ $image }}" alt="{{ $image }}" class="menus-image">
                            <div class="card-body p-2">
                                <h6 class="card-title menu-title-wrap"><a href="{{ route('menus.show', $menu->id) }}" class="stretched-link text-decoration-none text-success font-weight-bold">{{ $menu->name }}</a></h6>
                                <h6 class="card-subtitle text-orange font-weight-bold">Rp {{ number_format($menu->price,0 ,0, '.') }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-center mt-1">
                {{ $menus->links() }}
            </div>
        @endif
    </div>
@endsection