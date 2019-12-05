@extends('layouts.app')

@section('title', '| Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::user()->status == 'Active')
                        @if (Auth::user()->level == 'Owner')
                            Hi Owner
                        @else
                            @if (Auth::user()->level == 'Admin')
                                Hi Admin
                            @else
                                @if (Auth::user()->level == 'Cashier')
                                    Hi Cashier
                                @else
                                    @if (Auth::user()->level == 'Waiter')
                                        Hi Waiter
                                    @else
                                        @if (Auth::user()->level == 'Customer')
                                            Hi Customer
                                        @else
                                            
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endif
                    @else
                        Hi <b>{{ Auth::user()->name }}</b>, You're nonactive as <b>{{ Auth::user()->level }}</b>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
