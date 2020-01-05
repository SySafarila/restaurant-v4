@extends('layouts.app')

@section('title')
    | Search
@endsection

@section('content')
    <div class="container">
        <div class="card">
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
@endsection