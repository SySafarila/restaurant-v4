@extends('layouts.app')

@section('title', '| Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-md-8"> --}}
            {{-- <div class="card"> --}}
                {{-- <div class="card-header">Dashboard</div> --}}

                {{-- <div class="card-body"> --}}
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
                                <div class="col-md-4 col-6 mb-4">
                                    <div class="card ">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                        <h5 class="card-title">Light card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6 mb-4">
                                    <div class="card ">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                        <h5 class="card-title">Light card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6 mb-4">
                                    <div class="card ">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                        <h5 class="card-title">Light card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6 mb-4">
                                    <div class="card ">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                        <h5 class="card-title">Light card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6 mb-4">
                                    <div class="card ">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                        <h5 class="card-title">Light card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
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
                {{-- </div> --}}
            {{-- </div> --}}
        {{-- </div> --}}
    </div>
</div>
@endsection
