@extends('layouts.app')

@section('title', '| Users')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card border-0">
                <div class="card-body p-0">
                    <form action="{{ route('users.search') }}" method="get">
                        <div class="input-group mb-3">
                            <input type="text" name="username" class="rounded-pill mr-1 form-control form-control-sm @error('username') is-invalid @enderror" placeholder='Search Username without "@"' required>
                            <div class="input-group-append">
                                <button type="submit" class="rounded-pill btn btn-sm btn-success ml-1"><i class="material-icons align-middle" style="font-size:15px; padding-bottom:2px;">search</i></button>
                            </div>
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="w-75">Name</th>
                                    <th scope="col" class="text-center">Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $number++ }}</td>
                                        <td><a href="{{ route('users.show', $user->username) }}" class="text-decoration-none text-dark">{{ $user->name }}</a></td>
                                        <td class="text-center">
                                            <span class="badge 
                                                @if($user->level == 'Admin')
                                                    badge-success 
                                                @else
                                                    @if($user->level == 'Owner')
                                                        badge-warning
                                                    @else
                                                        badge-secondary
                                                    @endif 
                                                @endif">{{ $user->level }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection