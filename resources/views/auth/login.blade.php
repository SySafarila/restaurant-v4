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
                            <input type="text" class="form-control input-field text-truncate" name="email" id="email" value="{{ old('email') }}" required onkeyup="validatingEmail()">
                            <label for="email" class="input-label">Email</label>
                        </div>
                        <div class="modern-form" style="margin-bottom: 0.5rem;">
                            <input type="password" class="form-control input-field" name="password" id="password" onkeyup="validatingPassword()" required>
                            <label for="password" class="input-label">Password</label>
                        </div>
                        <div class="custom-control custom-checkbox my-3">
                            <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                            <label class="custom-control-label" for="remember" style="cursor: pointer; user-select: none;">Remember me</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-primary font-weight-bold text-decoration-none">Forgot password ?</a>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="{{ route('register') }}" class="text-primary font-weight-bold text-decoration-none">Create Account</a>
                            <button type="submit" class="btn btn-sm btn-danger" id="loginButton" disabled>Login</button>
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
@section('script')
<script>
    const regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const email = document.getElementById('email');
    if (regex.test(email.value) === true) {
        email.classList.add('true');
        email.style.borderColor = '#38c172';
    }

    function validatingEmail() {
        const regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const loginButton = document.getElementById('loginButton');
        if (regex.test(email.value) === true) {
            document.getElementById('email').style.borderColor = '#38c172';
            document.getElementById('email').classList.add('true');
        } else {
            if (document.getElementById('email').classList.contains('true')) {
                document.getElementById('email').classList.remove('true');
            }
            document.getElementById('email').style.borderColor = '#e3342f';
        }

        if (email.classList.contains('true') && password.classList.contains('true')) {
            loginButton.disabled = false;
            loginButton.classList.remove('btn-danger');
            loginButton.classList.add('btn-success');
        } else {
            loginButton.disabled = true;
            loginButton.classList.remove('btn-success');
            loginButton.classList.add('btn-danger');
        }
    }

    function validatingPassword() {
        const password = document.getElementById('password');
        const email = document.getElementById('email');
        const loginButton = document.getElementById('loginButton');
        if (password.value.length >= 8) {
            document.getElementById('password').style.borderColor = '#38c172';
            document.getElementById('password').classList.add('true');
        } else {
            if (document.getElementById('password').classList.contains('true')) {
                document.getElementById('password').classList.remove('true');
            }
            document.getElementById('password').style.borderColor = '#e3342f';
        }

        if (email.classList.contains('true') && password.classList.contains('true')) {
            loginButton.disabled = false;
            loginButton.classList.remove('btn-danger');
            loginButton.classList.add('btn-success');
        } else {
            loginButton.disabled = true;
            loginButton.classList.remove('btn-success');
            loginButton.classList.add('btn-danger');
        }
    }

    // function loginCheck() {
    //     const email = document.getElementById('email');
    //     const password = document.getElementById('password');
    // }
</script>
@endsection