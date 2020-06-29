@extends('layouts.app')

@section('title', '| Create Menu')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('menus.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <div class="modern-form" style="margin-bottom: 0.5rem;">
                                    <input type="text" class="form-control input-field text-truncate" name="name" value="{{ old('name') }}" required>
                                    <label for="name" class="input-label">Name</label>
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="modern-form" style="margin-bottom: 0.5rem;">
                                    <textarea class="form-control input-field" rows="5" name="description" required>{{ old('description') }}</textarea>
                                    <label for="name" class="input-label">Description</label>
                                </div>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="modern-form" style="margin-bottom: 0.5rem;">
                                    <input type="number" class="form-control input-field text-truncate" name="price" value="{{ old('price') }}" required>
                                    <label for="price" class="input-label">Price</label>
                                </div>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="modern-form" style="margin-bottom: 0.5rem;">
                                    <select name="category" class="form-control input-field">
                                        <option value="">Select Category</option>
                                        <option value="Foods">Food's</option>
                                        <option value="Drinks">Drink's</option>
                                    </select>
                                    <label for="category" class="input-label">Category</label>
                                </div>
                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <div class="modern-form" style="margin-bottom: 0.5rem;">
                                    <input type="number" class="form-control input-field text-truncate" name="stock" value="{{ old('stock') }}" required>
                                    <label for="stock" class="input-label">Stock</label>
                                </div>
                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <hr>
                            <div class="form-row mb-3">
                                <div class="col">
                                    <label for="images">Images</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="cover_image" name="cover_image" required>
                                        <label class="custom-file-label text-truncate" for="cover_image">Choose Cover *</label>
                                        @error('cover_image')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="custom-file mt-2">
                                        <input type="file" class="custom-file-input" id="images" name="images[]" multiple>
                                        <label class="custom-file-label text-truncate" for="images">Choose Other Images</label>
                                        @error('images.*')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                        <div class="alert alert-warning alert-dismissible fade show mt-2 shadow-sm" role="alert">
                                            <div class="d-flex">
                                                <span class="material-icons mr-2">info</span>
                                                <span>{{ $error }}</span>
                                            </div>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endforeach
                                    @endif
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