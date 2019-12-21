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
        <div class="row justify-content-center">
            <div class="col-md-9 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:25px;">No</th>
                                        <th>Name</th>
                                        <th class="text-center" style="width:25px;">Quantity</th>
                                        <th class="text-center" style="width:25px;">Price</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center align-middle">{{ $number++ }}</td>
                                            <td class="align-middle">
                                                {{ $order->menu->name }} - <a class="text-danger text-decoration-none" href="{{ route('orders.destroyOne', $order->id) }}" onclick="event.preventDefault(); document.getElementById('orders.destroyOne').submit();">{{ __('Delete') }}</a>
                                                <form id="orders.destroyOne" action="{{ route('orders.destroyOne', $order->id) }}" method="post" class="d-none">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="d-flex justify-content-center">
                                                        <button class="btn btn-sm btn-outline-danger" type="submit">destroyOne</button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="text-center align-middle">{{ $order->quantity }}</td>
                                            <td class="text-center align-middle">{{ number_format($order->menu->price) }}</td>
                                            <td class="text-center align-middle">{{ number_format($order->menu->price * $order->quantity) }}</td>
                                        </tr>
                                    @endforeach
                                    @if ($orders->sum('total') < 1)
                                    <tr>
                                        <td colspan="5" class="text-center">Empty</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="4" class="text-center align-middle font-weight-bold text-success">Total ( Rp )</td>
                                        <td class="text-center align-middle text-success font-weight-bold">{{ number_format($orders->sum('total')) }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if (count($orders) < 1)
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('menus.index') }}" class="btn btn-sm btn-success">Order Now</a>
                        </div>
                        @else
                            <form action="{{ route('orders.destroy') }}" method="post">
                                @csrf
                                @method('delete')
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Empty Orders</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection