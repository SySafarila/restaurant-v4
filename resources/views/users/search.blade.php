@extends('layouts.app')

@section('title')
    | Search
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @empty($user)
                            <h1 class="text-muted text-center">Empty</h1>
                        @else
                            <p>{{ $user->username }}</p>
                            <p>{{ $user->name }}</p>
                            <p>{{ $user->email }}</p>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection