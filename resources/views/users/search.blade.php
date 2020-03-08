@extends('layouts.app')

@section('title')
    | Search
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
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
                            <table class="table table-bordered table-hover shadow-sm">
                                <thead>
                                    <tr>
                                        <th colspan="3" class="text-center"><span class="text-success">{{ '@' . $user->username }}</span>'s Orders</th>
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
                                            <td class="align-middle">{{ $order->menu->name }} <span class="badge badge-pill badge-success align-middle">{{ $order->quantity }}</span>
                                                <br>
                                            @if ($order->menu->stock - $order->quantity <= 0)
                                                <span class="badge badge-warning algn-middle">Product Is Not Enough</span>
                                            @endif
                                            @if ($order->menu->stock == 0)
                                                <span class="badge badge-danger algn-middle">Out Of Stock</span>
                                            @endif
                                            </td>
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
                        <form action="{{ route('invoices.store') }}" method="post">
                            @foreach ($user->orders as $order)
                            <input type="hidden" name="orderId[]" value="{{ $order->id }}">
                            @endforeach
                            <div class="d-flex">
                                @csrf
                                @if ($user->orders->count() == 0)
                                    <h3 class="text-center text-muted mx-auto">Empty</h3>
                                @else
                                    <button class="mx-auto btn btn-sm btn-outline-success">Pay !</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection