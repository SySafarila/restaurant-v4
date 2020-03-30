@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                @if (Auth::user()->img == null)
                    <form action="{{ route('profile.updateAvatar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="avatar" class="form-control-file" required>
                        <button type="submit">Submit</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection