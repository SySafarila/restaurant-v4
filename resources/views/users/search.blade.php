@extends('layouts.app')

@section('title')
    | Search
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                {{-- Breadcrumb --}}
                <div class="my-breadcrumb d-flex pb-3">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-success">Dashboard</a>
                    <span class="text-muted px-2">/</span>
                    <a href="{{ route('users.index') }}" class="text-decoration-none text-success">Users</a>
                    <span class="text-muted px-2">/</span>
                    <p class="text-muted m-0">{{ '@' . $user->username }}</p>
                </div>
                <div class="card border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered shadow-sm">
                                <thead>
                                    <tr>
                                        <th colspan="3" class="text-center">Orders <span class="text-muted">{{ '@' . $user->username }}</span></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center align-middle">No</th>
                                        <th class="align-middle">Name</th>
                                        <th class="text-center align-middle">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->orders as $order)
                                        <tr>
                                            <td class="text-center align-middle">{{ $number++ }}</td>
                                            <td class="align-middle">{{ $order->menu->name }} <span class="badge badge-success align-middle">{{ $order->quantity }}</span></td>
                                            <td class="text-center align-middle font-weight-bold text-success">{{ number_format($order->price * $order->quantity, 0, 0, '.') }}</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td colspan="2" class="text-center font-weight-bold">Total ( Rp )</td>
                                            <td class="font-weight-bold text-success text-center align-middle">{{ number_format($user->orders->sum('total'), 0, 0, '.') }}</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex">
                            <button class="mx-auto btn btn-sm btn-success">Button</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection