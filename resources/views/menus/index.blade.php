@extends('layouts.app')

@section('title', '| Menus')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }} <a href="{{ route('orders.index') }}" class="alert-link">Orders</a>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('status_menu'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status_menu') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="card-deck justify-content-center">
            @if (Auth::user()->level == 'Admin')
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Add Menu</h5>
                        <form action="{{ route('menus.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <input type="text" name="name" id="" value="{{ old('name') }}" class="form-control form-control-sm mb-1 @error('name') is-invalid @enderror" placeholder="Name" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <textarea rows="5" name="description" value="{{ old('description') }}" id="" class="form-control form-control-sm mb-1 @error('description') is-invalid @enderror" placeholder="Description" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <input type="number" name="price" id="" value="{{ old('price') }}" class="form-control form-control-sm mb-1 @error('price') is-invalid @enderror" placeholder="Price" required>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <input type="text" name="img" value="{{ old('img') }}" id="" class="form-control form-control-sm mb-1 @error('img') is-invalid @enderror" placeholder="Image *link" required>
                            @error('img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-row" style="margin-bottom:-12px;">
                                <div class="form-group col">
                                    <input type="number" name="stock" value="{{ old('stock') }}" id="" class="form-control form-control-sm @error('stock') is-invalid @enderror" placeholder="Stock" required>
                                        @error('stock')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group col">
                                    <select name="status" value="{{ old('status') }}" id="" class="custom-select custom-select-sm @error('status') is-invalid @enderror" required>
                                        <option value="" selected>- Status -</option>
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                                <button type="submit" class="btn btn-sm btn-success btn-block" style="margin-bottom:-4px;" >Add</button>
                                <button type="reset" class="btn btn-sm btn-danger btn-block">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @foreach ($menus as $menu)
            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ $menu->img }}" alt="{{ $menu->name }}" class="card-img-top mx-auto">
                    <div class="card-body">
                        <a href="{{ route('menus.show', $menu->id) }}" class="card-title h5 text-success text-uppercase text-decoration-none @if(Auth::user()->level == 'Customer') stretched-link @else   @endif">{{ $menu->name }}</a>
                        <p class="card-text">{{ Str::limit( $menu->description, 80, ' . . .' ) }}</p>
                        <p class="card-text font-weight-bold text-success text-center">{{ 'Rp ' . number_format($menu->price) }}</p>
                        @if (Auth::user()->level == 'Admin')
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-success">Edit</a>
                                <form action="{{ route('menus.destroy', $menu->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        @else
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection