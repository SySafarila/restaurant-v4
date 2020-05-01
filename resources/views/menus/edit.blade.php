@php
    if (Storage::disk('local')->exists('public/menuImages/' . $menu->cover->name)) {
        $cover = asset('storage/menuImages/' . $menu->cover->name);
    } else {
        $cover = asset('image-not-found.png');
    }
    
@endphp
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
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit Menu</h5>
                        <form action="{{ route('menus.update', $menu->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <label for="name">Menu</label>
                            <input type="text" name="name" id="name" value="{{ $menu->name }}" class="form-control form-control-sm mb-2 @error('name') is-invalid @enderror" placeholder="Name" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            <label for="description">Description</label>
                            <textarea rows="10" name="description" value="" id="description" class="form-control form-control-sm mb-2 @error('description') is-invalid @enderror" placeholder="Description" required>{{ $menu->description }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" value="{{ $menu->price }}" class="form-control form-control-sm mb-2 @error('price') is-invalid @enderror" placeholder="Price" required>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            {{-- <input type="text" name="img" value="{{ $menu->img }}" id="" class="form-control form-control-sm mb-1 @error('img') is-invalid @enderror" placeholder="Image *link" disabled>
                            @error('img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror --}}
                            <div class="form-row" style="margin-bottom:-12px;">
                                <div class="form-group col">
                                    <label for="stock">Stock</label>
                                    <input type="number" name="stock" value="{{ $menu->stock }}" id="stock" class="form-control form-control-sm @error('stock') is-invalid @enderror" placeholder="Stock" required>
                                        @error('stock')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="status">Status</label>
                                    <select name="status" value="{{ $menu->status }}" id="status" class="custom-select custom-select-sm @error('status') is-invalid @enderror" disabled>
                                        <option value="{{ $menu->status }}" selected>{{ 'Default : ' . $menu->status }}</option>
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
                                <button type="submit" class="btn btn-sm btn-success mr-2 col-5">Edit</button>
                                <a href="{{ route('menus.index') }}" class="btn btn-sm btn-danger ml-2 col-5">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="text-center">Edit Images</h5>
                        <img src="{{ $cover }}" alt="{{ $menu->cover->name }}" class="card-img-top">
                        <p class="text-center"><a href="{{ route('menus.editCover', $menu->id) }}" class="text-decoration-none">Edit Cover</a></p>
                        <hr>
                        <div class="d-flex justify-content-center">
                            <div class="row">
                                @foreach ($menu->images as $image)
                                    @php
                                        if (Storage::disk('local')->exists('public/menuImages/' . $image->name)) {
                                            $imageSrc = asset('storage/menuImages/' . $image->name);
                                        } else {
                                            $imageSrc = asset('image-not-found.png');
                                        }
                                        
                                    @endphp
                                <div class="col">
                                    <img src="{{ $imageSrc }}" alt="{{ $image->name }}" class="img-thumbnail">
                                    <p class="text-center"><a href="{{ route('menus.editImage', ['menu' => $menu->id, 'image' => $image->id]) }}" class="text-decoration-none">Edit Image</a></p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection