@extends('layouts.app')

{{-- @section('title', '| Dashboard') --}}

@section('title')
    | {{ Auth::user()->level }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('status-denied'))
            <div class="alert alert-danger" role="alert">
                {{ session('status-denied') }}
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
        {{-- <div class="col-md-8"> --}}
            {{-- <div class="card"> --}}
                {{-- <div class="card-header">Dashboard</div> --}}

                {{-- <div class="card-body"> --}}
                    {{-- @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    @if (Auth::user()->status == 'Active')
                        @if (Auth::user()->level == 'Owner')
                        {{-- OWNER PAGE --}}
                            <div class="col-md-4 col-12 mb-4">
                                <div class="card shadow-sm">
                                    <a href="{{ route('users.index') }}" class="card-body text-decoration-none">
                                        <h5 class="card-title text-dark">Users Panel</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Show, add, edit, or delete</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-4">
                                <div class="card shadow-sm">
                                    <a href="#" class="card-body text-decoration-none">
                                        <h5 class="card-title text-dark">Employees Panel</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Show, add, edit, or delete</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-4">
                                <div class="card shadow-sm">
                                    <a href="#" class="card-body text-decoration-none">
                                        <h5 class="card-title text-dark">Transactions Panel</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Show, add, edit, or delete</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-4">
                                <div class="card shadow-sm">
                                    <a href="{{ route('menus.index') }}" class="card-body text-decoration-none">
                                        <h5 class="card-title text-dark">Menus Panel</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Show, add, edit, or delete</h6>
                                    </a>
                                </div>
                            </div>
                        @else
                            @if (Auth::user()->level == 'Admin')
                            {{-- ADMIN PAGE --}}
                                <div class="col-md-4 col-12 mb-4">
                                    <div class="card shadow-sm">
                                        <a href="{{ route('menus.index') }}" class="card-body text-decoration-none">
                                            <h5 class="card-title text-dark">Menus List</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Organizer Foods, Drinks, Desserts, Cakes, Etc</h6>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12 mb-4">
                                    <div class="card shadow-sm">
                                        <a href="{{ route('users.index') }}" class="card-body text-decoration-none">
                                            <h5 class="card-title text-dark">Users List</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Organizer Users</h6>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12 mb-4">
                                    <div class="card shadow-sm">
                                        <a href="#" class="card-body text-decoration-none">
                                            <h5 class="card-title text-dark">Employees List</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Organizer Employees</h6>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12 mb-4">
                                    <div class="card shadow-sm">
                                        <a href="#" class="card-body text-decoration-none">
                                            <h5 class="card-title text-dark">Transactions List</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Organizer Transactions</h6>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12 mb-4">
                                    <div class="card shadow-sm">
                                        <a href="{{ route('orders.index') }}" class="card-body text-decoration-none">
                                            <h5 class="card-title text-dark">Orders List</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Organizer Orders</h6>
                                        </a>
                                    </div>
                                </div>
                            @else
                                @if (Auth::user()->level == 'Cashier')
                                {{-- CASHIER PAGE --}}
                                    <div class="col-md-4 col-12 mb-4">
                                        <div class="card shadow-sm">
                                            <a href="#" class="card-body text-decoration-none">
                                                <h5 class="card-title text-dark">Orders Panel</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">Show, add, edit, or delete</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mb-4">
                                        <div class="card shadow-sm">
                                            <a href="#" class="card-body text-decoration-none">
                                                <h5 class="card-title text-dark">Transactions Panel</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">Show, add, edit, or delete</h6>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    @if (Auth::user()->level == 'Waiter')
                                    {{-- WAITER PAGE --}}
                                        Hi Waiter
                                    @else
                                        @if (Auth::user()->level == 'Customer')
                                        {{-- CUSTOMER PAGE --}}
                                            <div class="col-md-4 col-12 mb-4">
                                                <div class="card shadow-sm">
                                                    <a href="{{ route('menus.index') }}" class="card-body text-decoration-none">
                                                        <h5 class="card-title text-dark">Menus List</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">Foods, Drinks, Desserts, Cakes, Etc.</h6>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12 mb-4">
                                                <div class="card shadow-sm">
                                                    <a href="{{ route('orders.index') }}" class="card-body text-decoration-none">
                                                        <h5 class="card-title text-dark">My Orders <span class="badge badge-pill badge-success align-middle">{{ Auth::user()->orders->where('status', 'Pending')->count() }}</span></h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">Pending, Cooking, Success</h6>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12 mb-4">
                                                <div class="card shadow-sm">
                                                    <a href="#" class="card-body text-decoration-none">
                                                        <h5 class="card-title text-dark">Transactions List</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">Invoices</h6>
                                                    </a>
                                                </div>
                                            </div>
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
