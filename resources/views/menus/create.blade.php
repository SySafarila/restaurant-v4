@extends('layouts.app')

@section('title')
    | Create Menu
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form action="{{ route('menus.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="product">Product Name</label>
                        <input type="text" id="product" name="name" value="{{ old('name') }}" class="form-control form-control-sm mb-1 @error('name') is-invalid @enderror" placeholder="Product Name" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea rows="5" id="description" name="description" value="{{ old('description') }}" class="form-control form-control-sm mb-1 @error('description') is-invalid @enderror" placeholder="Description" required>{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}" class="form-control form-control-sm mb-1 @error('price') is-invalid @enderror" placeholder="Price" required>
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image_link">Image Link</label>
                        <input type="text" id="image_link" name="img" value="{{ old('img') }}" class="form-control form-control-sm mb-1 @error('img') is-invalid @enderror" placeholder="Image *link" required>
                        @error('img')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">
                            <label for="stock">Stock</label>
                            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" class="form-control form-control-sm @error('stock') is-invalid @enderror" placeholder="Stock" required>
                            @error('stock')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="status">Status</label>
                            <select name="status" id="status" value="{{ old('status') }}" class="custom-select custom-select-sm @error('status') is-invalid @enderror" required>
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
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-sm btn-success mx-1 material-icons">add</button>
                        <button type="reset" class="btn btn-sm btn-outline-danger mx-1 material-icons">delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection