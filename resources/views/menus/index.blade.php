@extends('layouts.app')

@section('title', '| Menus')

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
        @if (Auth::user()->level == 'Admin')
            <div class="col-md-4">
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
                                    <select name="status" value="{{ old('status') }}" id="" class="form-control form-control-sm @error('status') is-invalid @enderror" required>
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
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-sm btn-success mr-2 col-5">Add</button>
                                <button type="reset" class="btn btn-sm btn-danger ml-2 col-5">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @foreach ($menus as $menu)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="{{ $menu->img }}" alt="{{ $menu->name }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $menu->name }}</h5>
                    <p class="card-text">{{ Str::limit( $menu->description, 80, ' . . .' ) }}</p>
                    <p class="card-text">{{ 'Rp ' . number_format($menu->price) . '-,' }} | {{ 'Stock : ' . $menu->stock}}</p>
                    @if (Auth::user()->level == 'Admin')
                        <div class="d-flex justify-content-between">
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            {{-- <a href="{{ route('menus.destroy', $menu->id) }}" class="btn btn-sm btn-danger">Delete</a> --}}
                            <a href="#" class="btn btn-sm btn-success">Edit</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection