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
                                <div class="col-md-4 col-12 mb-1">
                                    <div class="card mb-3">
                                        <div class="row no-gutters">
                                            <div class="col-4">
                                                <img src="http://www.attachmax.com/p/2018/12/restaurant-menu-design-free-psd-free-photoshop-downloads-pertaining-to-menu-cover-design-templates-600x600.jpg" class="card-img h-100" alt="...">
                                            </div>
                                            <div class="col-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Menus</h5>
                                                <p class="card-text">Add, edit, or delete menus.</p>
                                                {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12 mb-1">
                                    <div class="card mb-3">
                                        <div class="row no-gutters">
                                            <div class="col-4">
                                                <img src="http://www.attachmax.com/p/2018/12/restaurant-menu-design-free-psd-free-photoshop-downloads-pertaining-to-menu-cover-design-templates-600x600.jpg" class="card-img h-100" alt="...">
                                            </div>
                                            <div class="col-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Users</h5>
                                                <p class="card-text">Show, edit, or delete users.</p>
                                                {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12 mb-1">
                                    <div class="card mb-3">
                                        <div class="row no-gutters">
                                            <div class="col-4">
                                                <img src="http://www.attachmax.com/p/2018/12/restaurant-menu-design-free-psd-free-photoshop-downloads-pertaining-to-menu-cover-design-templates-600x600.jpg" class="card-img h-100" alt="...">
                                            </div>
                                            <div class="col-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Employees</h5>
                                                <p class="card-text">Show, edit, or delete Employeessssssssssssssssssssssssssssssssssssssssssssssssssssssssss.</p>
                                                {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                                            </div>
                                            </div>
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
