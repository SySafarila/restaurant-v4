@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @if (Auth::user()->img == null)
                    <form action="{{ route('profile.updateAvatar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="avatar" class="form-control-file">
                        <button type="submit">Submit</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection