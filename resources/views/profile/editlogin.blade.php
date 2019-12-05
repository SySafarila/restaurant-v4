@extends('layouts.app')

@section('title', '| Profile - Edit Password')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body table-responsive">
                    <form action="{{ route('profile.updatelogin') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <table class="table table-bordered">
                            <tr>
                                <td class="align-middle">New Email</td>
                                <td>
                                    <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">New / Old Password</td>
                                <td>
                                    <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">Confirm Password</td>
                                <td>
                                    <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" required autocomplete="new-password">
                                </td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-danger mx-1">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-outline-success mx-1">Edit Profile</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection