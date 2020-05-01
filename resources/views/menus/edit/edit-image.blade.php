@php
    if (Storage::disk('local')->exists('public/menuImages/' . $image->name) == true) {
        $imageSrc = asset('storage/menuImages/' . $image->name);
    } else {
        $imageSrc = asset('image-not-found.png');
    }
@endphp
@extends('layouts.app')

@section('title', '| Edit Cover')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <img src="{{ $imageSrc }}" alt="{{ $image->name }}" class="card-img-top">
                    <div class="card-body">
                        <form action="{{ route('menus.updateImage', ['menu' => $menu->id, 'image' => $image->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="newCover">New Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="newImage" name="newImage" required>
                                    <label class="custom-file-label text-truncate" for="newImage">Choose New Image</label>
                                    @error('newImage')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success">Edit</button>
                            @foreach ($errors->all() as $error)
                                <li class="text-danger mt-2">{{ $error }}</li>
                            @endforeach
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