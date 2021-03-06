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
    <x-alert.status-success />
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

                            <div class="form-row" style="margin-bottom:-12px;">
                                <div class="form-group col">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" value="{{ $menu->price }}" class="form-control form-control-sm mb-2 @error('price') is-invalid @enderror" placeholder="Price" required>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="category">Category</label>
                                    <select name="category" class="custom-select custom-select-sm @error('category') is-invalid @enderror" required>
                                        <option value="{{ $menu->category }}">Default : {{ $menu->category }}</option>
                                        <option value="Foods">Food's</option>
                                        <option value="Drinks">Drink's</option>
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

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
                        <div class="d-flex">
                            <div class="row justify-content-center">
                                @foreach ($menu->images as $image)
                                    @php
                                        if (Storage::disk('local')->exists('public/menuImages/' . $image->name)) {
                                            $imageSrc = asset('storage/menuImages/' . $image->name);
                                        } else {
                                            $imageSrc = asset('image-not-found.png');
                                        }
                                        
                                    @endphp
                                <div class="col-6 col-md-3">
                                    <img src="{{ $imageSrc }}" alt="{{ $image->name }}" class="img-thumbnail">
                                    <p class="text-center"><a href="{{ route('menus.editImage', ['menu' => $menu->id, 'image' => $image->id]) }}" class="text-decoration-none">Edit Image</a></p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        {{-- <p class="text-center m-0">Want add more ?</p> --}}
                        <form action="{{ route('menus.addImages', $menu->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="newImages">Add New Images</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="newImages" name="newImages[]" required multiple>
                                    <label class="custom-file-label text-truncate" for="newImages">Choose New Cover</label>
                                    @error('newImages')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success">Upload</button>
                        </form>
                        {{-- <p class="text-center m-0"><a href="#" class="text-decoration-none">Add more images</a></p> --}}
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                                {{ $error }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init()
        });
</script>
@endsection