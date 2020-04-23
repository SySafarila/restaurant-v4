@extends('layouts.app')

@section('title', '| Deleted Menus')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="mx-md-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif
    @if (session('status_menu'))
    <div class="mx-md-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status_menu') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif
    <div class="card-group justify-content-center">
        @foreach ($menus as $menu)
            <div class="col-12 col-md-3 pb-md-3 px-0 px-md-2">
                <div class="card mb-3 h-100 shadow-sm">
                    {{-- <img src="{{ $menu->img }}" class="card-img-top" alt="{{ $menu->name }}"> --}}
                    <div class="card-img-top text-center px-4 py-5 bg-dark text-muted font-weight-bold">Image isn't available</div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('menus.show', $menu->id) }}" class="text-decoration-none text-success font-weight-bold">{{ $menu->name }}</a></h5>
                        <h6 class="card-subtitle mb-2 text-orange font-weight-bold">Rp {{ number_format($menu->price,0 ,0, '.') }}</h6>
                        <span class="text-muted">{{ $menu->deleted_at->diffForHumans() }}</span>
                        <br>
                        <p class="card-text">{{ Str::limit($menu->description, 50) }}</p>

                        <form action="{{ route('menus.restore', $menu->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="stock" class="form-control form-control-sm @error('stock') is-invalid @enderror" value="{{ $menu->stock }}" required>
                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button type="submit" class="btn btn-sm btn-success btn-block mt-2">Restore</button>
                        </form>
                        <form action="#" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger btn-block mt-2">Delete Permanent</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            @if ($count == 0)
                <h1 class="text-muted text-center">Empty</h1>
            @endif
    </div>
</div>
@endsection