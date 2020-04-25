@extends('layouts.app')

@section('title', '| Create Menu')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form action="{{ route('menus.store') }}" method="post" enctype="multipart/form-data">
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
                        <input type="text" id="image_link" name="img" value="{{ old('img') }}" class="form-control form-control-sm mb-1 @error('img') is-invalid @enderror" placeholder="Image *link" disabled>
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
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">
                            <label for="images">Images <small class="text-danger">*First image is required</small></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image_1" name="image_1" required>
                                <label class="custom-file-label" for="image_1">Choose Image 1</label>
                            </div>
                            <div class="custom-file mt-2">
                                <input type="file" class="custom-file-input" id="image_2" name="image_2" disabled>
                                <label class="custom-file-label" for="image_2">Choose Image 2</label>
                            </div>
                            <div class="custom-file mt-2">
                                <input type="file" class="custom-file-input" id="image_3" name="image_3" disabled>
                                <label class="custom-file-label" for="image_3">Choose Image 3</label>
                            </div>
                            <div class="custom-file mt-2">
                                <input type="file" class="custom-file-input" id="image_4" name="image_4" disabled>
                                <label class="custom-file-label" for="image_4">Choose Image 4</label>
                            </div>
                            <div class="custom-file mt-2">
                                <input type="file" class="custom-file-input" id="image_5" name="image_5" disabled>
                                <label class="custom-file-label" for="image_5">Choose Image 5</label>
                            </div>
                            {{-- <input type="number" id="stock" name="stock" value="{{ old('stock') }}" class="form-control form-control-sm @error('stock') is-invalid @enderror" placeholder="Stock" required> --}}
                            @error('stock')
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
@section('script')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init()
        })
</script>
@endsection