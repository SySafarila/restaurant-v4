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
                        <h5 class="card-title text-center">Add Menu</h5>
                        <form action="{{ route('menus.update', $menu->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="text" name="name" id="" value="{{ $menu->name }}" class="form-control form-control-sm mb-1 @error('name') is-invalid @enderror" placeholder="Name" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <textarea rows="10" name="description" value="" id="" class="form-control form-control-sm mb-1 @error('description') is-invalid @enderror" placeholder="Description" required>{{ $menu->description }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <input type="number" name="price" id="" value="{{ $menu->price }}" class="form-control form-control-sm mb-1 @error('price') is-invalid @enderror" placeholder="Price" required>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <input type="text" name="img" value="{{ $menu->img }}" id="" class="form-control form-control-sm mb-1 @error('img') is-invalid @enderror" placeholder="Image *link" required>
                            @error('img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-row" style="margin-bottom:-12px;">
                                <div class="form-group col">
                                    <input type="number" name="stock" value="{{ $menu->stock }}" id="" class="form-control form-control-sm @error('stock') is-invalid @enderror" placeholder="Stock" required>
                                        @error('stock')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group col">
                                    <select name="status" value="{{ $menu->status }}" id="" class="custom-select custom-select-sm @error('status') is-invalid @enderror" required>
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
        @endif
    </div>
</div>
@endsection