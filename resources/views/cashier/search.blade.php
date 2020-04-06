@extends('layouts.cashier')

@section('title')
    Cashier
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-muted text-center">Search User</h3>
                        <form action="{{ route('payment.search') }}" method="get">
                            <input type="text" name="username" id="username" class="form-control" placeholder="@username" required>
                            <button type="submit" class="btn btn-sm btn-block btn-success mt-2">Search</button>
                        </form>
                        <hr>
                        <p class="mb-0">
                            Search example : <span class="text-success">@</span><span class="text-orange">username</span>
                        </p>
                        <p class="mb-0">
                            Note : Input the username without '<span class="text-orange">@</span>'
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection