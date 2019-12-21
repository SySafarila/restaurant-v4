@extends('layouts.app')

@section('title')
    | Orders
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <div class="row">
                                        <th class="text-center">No</th>
                                        <th>Name</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Total</th>
                                    </div>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-center align-middle">{{ $number++ }}</td>
                                        <td class="align-middle">{{ $order->menu->name }}</td>
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
                                    <td colspan="4" class="text-center align-middle">Total ( Rp )</td>
                                    <td class="text-center align-middle">{{ number_format($orders->sum('total')) }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection