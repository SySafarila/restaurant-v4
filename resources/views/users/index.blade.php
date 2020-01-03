@extends('layouts.app')

@section('title', '| Users')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-warning" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body table-responsive">
                    <form action="{{ route('users.search') }}" method="get">
                        <input type="text" name="username">
                        <button type="submit">Search</button>
                    </form>
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
                                    <td><a href="user/{{ $user->id }}" class="text-decoration-none text-dark">{{ $user->name }}</a></td>
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
@endsection