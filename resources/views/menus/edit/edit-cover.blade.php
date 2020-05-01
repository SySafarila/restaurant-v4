@php
    if (Storage::disk('local')->exists('public/menuImages/' . $menu->cover->name) == true) {
        $image = asset('storage/menuImages/' . $menu->cover->name);
    } else {
        $image = asset('image-not-found.png');
    }
@endphp
@extends('layouts.app')

@section('title', '| Edit Cover')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <img src="{{ $image }}" alt="{{ $menu->cover->name }}" class="card-img-top">
                    <div class="card-body">
                        <form action="{{ route('menus.updateCover', $menu->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="newCover">New Cover</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="newCover" name="newCover" required>
                                    <label class="custom-file-label text-truncate" for="newCover">Choose New Cover</label>
                                    @error('newCover')
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