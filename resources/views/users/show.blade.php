@extends('layouts.app')

@section('title', '| Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body table-responsive">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2" class="text-center">Profile</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td class="text-capitalize">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td class="text-lowecase">{{ '@' . $user->username }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td class="text-lowecase">{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td class="text-capitalize">{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td class="text-capitalize">{{ $user->gender }}</td>
                        </tr>
                        <tr>
                            <td>Level</td>
                            <td class="text-capitalize">{{ $user->level }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td class="text-capitalize"><span class="badge @if($user->status == 'Active') badge-success @else badge-secondary @endif">{{ $user->status }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection