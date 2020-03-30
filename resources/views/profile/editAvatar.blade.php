@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile.updateAvatar') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="avatar">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success mt-2">Upload</button>
                        </form>
                    </div>
                </div>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                {{-- @if (Auth::user()->img == null)
                    <form action="{{ route('profile.updateAvatar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="avatar" class="form-control-file" required>
                        <button type="submit">Submit</button>
                    </form>
                @endif --}}
            </div>
        </div>
    </div>
@endsection