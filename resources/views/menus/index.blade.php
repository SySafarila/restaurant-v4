@extends('layouts.app')

@section('title', '| Menus')

@section('content')
<div class="container">
    <div class="card-group">
        @if (Auth::user()->level == 'Admin')
        <div class="col-12 col-md-3 py-0 pb-md-4">
            <div class="card mb-3 h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Add Menu</h5>
                    <form action="{{ route('menus.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm mb-1 @error('name') is-invalid @enderror" placeholder="Name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <textarea rows="5" name="description" value="{{ old('description') }}" class="form-control form-control-sm mb-1 @error('description') is-invalid @enderror" placeholder="Description" required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <input type="number" name="price" value="{{ old('price') }}" class="form-control form-control-sm mb-1 @error('price') is-invalid @enderror" placeholder="Price" required>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <input type="text" name="img" value="{{ old('img') }}" class="form-control form-control-sm mb-1 @error('img') is-invalid @enderror" placeholder="Image *link" required>
                        @error('img')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-row" style="margin-bottom:-12px;">
                            <div class="form-group col">
                                <input type="number" name="stock" value="{{ old('stock') }}" class="form-control form-control-sm @error('stock') is-invalid @enderror" placeholder="Stock" required>
                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group col">
                                <select name="status" value="{{ old('status') }}" class="custom-select custom-select-sm @error('status') is-invalid @enderror" required>
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
        <div class="col-12 col-md-3 py-0 pb-md-4">
            <div class="card mb-3 h-100 shadow-sm">
                <img src="{{ $menu->img }}" class="card-img-top" alt="{{ $menu->name }}">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('menus.show', $menu->id) }}" class="text-decoration-none text-success">{{ $menu->name }}</a></h5>
                    <p class="card-text">{{ Str::limit($menu->description, 50) }}</p>
                    @if (Auth::user()->level == 'Admin')
                        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-block btn-success my-1">Edit</a>
                        <form action="{{ route('menus.destroy', $menu->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-block btn-danger my-1">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection