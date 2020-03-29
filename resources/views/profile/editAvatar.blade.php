@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('profile.updateAvatar') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="avatar" class="form-control-file">
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection