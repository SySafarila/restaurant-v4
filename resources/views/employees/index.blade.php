@extends('layouts.app')

@section('title', '| Employees')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @foreach ($employees as $user)
                    <div class="card shadow-sm mb-3">
                        <div class="card-header bg-white font-weight-bold text-orange">{{ $user->name }}</div>
                        <a href="{{ route('users.show', $user->username) }}" class="stretched-link"></a>
                        <div class="card-body">
                            <ul class="m-0 pl-3">
                                <li>Registered : {{ $user->created_at->diffForHumans() }}</li>
                                <li>Level : {{ $user->level }}</li>
                                <li>Status : {{ $user->status }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection