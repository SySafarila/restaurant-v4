@extends('layouts.login')

@section('title', '| Login')

@section('content')
<div class="container">
    <x-alert />
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h1 class="material-icons d-block text-center" style="font-size: 5rem; margin-block: 2rem;">face</h1>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 material-icons pl-0" id="email">email</span>
                    </div>
                    <input type="email" class="form-control bg-transparent border-0 px-0" placeholder="Email" name="email" value="{{ old('email') }}" style="box-shadow: none;" required autofocus>
                </div>
                <hr style="margin-top: -0.6rem;">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 material-icons pl-0" id="password">lock</span>
                    </div>
                    <input type="password" class="form-control bg-transparent border-0 px-0" placeholder="Password" name="password" style="box-shadow: none;" required>
                </div>
                <hr style="margin-top: -0.6rem;">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                    <label class="custom-control-label" for="remember_me">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-block btn-success">Login</button>
            </form>
            @foreach ($errors->all() as $error)
                <div class="d-flex mt-3">
                    <p class="material-icons text-danger">info</p>
                    <p class="text-danger" style="margin-left: 0.5rem;">{{ $error }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection