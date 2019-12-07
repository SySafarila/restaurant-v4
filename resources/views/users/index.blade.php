@extends('layouts.app')

@section('title', '| Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="w-75">Name</th>
                                <th scope="col">Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $number++ }}</td>
                                    <td><a href="user/{{ $user->id }}" class="text-decoration-none text-dark">{{ $user->name }}</a></td>
                                    <td>{{ $user->level }}</td>
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