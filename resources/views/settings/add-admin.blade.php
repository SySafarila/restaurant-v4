@extends('layouts.app')

@section('title', '| Add Admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <x-alert.status-success />
                <x-alert.status-warning />
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="text-center">Add Admin</h3>
                        <form action="{{ route('setAdmin') }}" method="post">
                            @csrf
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="Add user email" required>
                            <button type="submit" class="btn btn-sm btn-outline-success mt-2 mx-auto d-flex">Add as Admin</button>
                        </form>
                        <ul class="mt-2">
                            @foreach ($admins as $admin)
                                <li>{{ $admin->name }} | {{ $admin->email }} <a href="#" class="text-danger text-decoration-none" onclick="event.preventDefault();document.getElementById('delete-admin').submit();">Delete</a></li>
                                <form action="{{ route('deleteAdmin', $admin->id) }}" method="post" id="delete-admin">
                                    @csrf
                                </form>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection