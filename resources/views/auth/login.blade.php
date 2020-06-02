@extends('layouts.login')

@section('title', '| Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body p-5">
                    <h5 class="text-center my-font text-success mb-4">Restaurant V4</h5>
                    <h3 class="text-center">Sign in</h3>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="modern-form" style="margin-bottom: 0.5rem;">
                            <input type="text" class="form-control input-field" name="email" value="{{ old('email') }}" required>
                            <label for="email" class="input-label">Email</label>
                        </div>
                        <div class="modern-form" style="margin-bottom: 0.5rem;">
                            <input type="password" class="form-control input-field" name="password" value="{{ old('password') }}" required>
                            <label for="password" class="input-label">Password</label>
                        </div>
                        <div class="custom-control custom-checkbox my-3">
                            <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                            <label class="custom-control-label" for="remember">Remember me</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-primary font-weight-bold text-decoration-none">Forgot password ?</a>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="{{ route('register') }}" class="text-primary font-weight-bold text-decoration-none">Create Account</a>
                            <button type="submit" class="btn btn-sm btn-success">Login</button>
                        </div>
                    </form>
                    @foreach ($errors->all() as $error)
                        <div class="d-flex align-items-center mt-3">
                            <span class="material-icons text-danger">info</span>
                            <span class="text-danger ml-2">{{ $error }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection