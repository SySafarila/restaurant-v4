@extends('layouts.app')

@section('title')
    | Orders
@endsection

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="row justify-content-center">
                <div class="col-md-9 col-sm-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        @if (session('status_warning'))
            <div class="row justify-content-center">
                <div class="col-md-9 col-sm-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('status_warning') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-9 col-sm-12">
                {{-- <div class="card shadow-sm"> --}}
                    {{-- <div class="card-body"> --}}
                        <div class="table-responsive">
                            <table class="table table-bordered shadow-sm">
                                <thead>
                                    <tr>
                                        <th colspan="5" class="text-center">Pending</th>
                                    </tr>
                                    <tr>
                                        {{-- <div class="row"> --}}
                                            <th class="text-center" scope="col">No</th>
                                            <th class="text-left" scope="col">Name</th>
                                            <th class="text-center" scope="col">Quantity</th>
                                            <th class="text-center" scope="col">Price</th>
                                            <th class="text-center" scope="col">Total</th>
                                        {{-- </div> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center align-middle">{{ $number++ }}</td>
                                            <td class="align-middle text-nowrap">
                                                {{ $order->menu->name }} <span class="badge @if($order->status == 'Pending') badge-warning @else badge-primary @endif">@if($order->status == 'Pending') Pending @else Cooking @endif</span>
                                                <br>
                                                @if ($order->status == 'Pending')
                                                <a href="{{ route('orders.edit', $order->id) }}" class="badge badge-success">Edit</a> <a class="text-decoration-none badge badge-danger align-middle" href="{{ route('orders.destroyOne', $order->id) }}" onclick="event.preventDefault(); document.getElementById('orders.destroyOne').submit();">{{ __('Delete') }}</a>
                                                @endif
                                                <form id="orders.destroyOne" action="{{ route('orders.destroyOne', $order->id) }}" method="post" class="d-none">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="d-flex justify-content-center">
                                                        <button class="btn btn-sm btn-outline-danger" type="submit">destroyOne</button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="text-center align-middle">{{ $order->quantity }}</td>
                                            <td class="text-center align-middle">{{ number_format($order->menu->price, 0, 0, '.') }}</td>
                                            <td class="text-center align-middle">{{ number_format($order->menu->price * $order->quantity, 0, 0, '.') }}</td>
                                        </tr>
                                    @endforeach
                                    @if ($orders->sum('total') < 1)
                                    <tr>
                                        <td colspan="5" class="text-center">Empty</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="4" class="text-center align-middle font-weight-bold text-success">Total ( Rp )</td>
                                        <td class="text-center align-middle text-orange font-weight-bold">{{ number_format($orders->sum('total'), 0, 0, '.') }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <p class="text-center text-muted">If several Orders disappear, it means the Orders has been deleted by the Admin</p>
                        @if (count($orders) < 1)
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('menus.index') }}" class="btn btn-sm btn-success mb-3">Order Now</a>
                        {{-- </div> --}}
                        @else
                            <form action="{{ route('orders.destroy') }}" method="post">
                                @csrf
                                @method('delete')
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-sm btn-outline-danger mb-3" type="submit">Empty Orders</button>
                                </div>
                            </form>
                        @endif
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection