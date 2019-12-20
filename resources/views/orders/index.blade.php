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
                                        <th class="text-center" style="width:10%;">No</th>
                                        <th>Name</th>
                                        <th class="text-center" style="width:10%;">Quantity</th>
                                        <th class="text-center" style="width:10%;">Price</th>
                                        <th class="text-center" style="width:10%;">Total</th>
                                    </div>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-center">{{ $number++ }}</td>
                                        <td>{{ $order->menu->name }}</td>
                                        <td class="text-center">{{ $order->quantity }}</td>
                                        <td class="text-center">{{ $order->menu->price }}</td>
                                        <td class="text-center">{{ $order->menu->price * $order->quantity }}</td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td colspan="4" class="text-center">Total</td>
                                        <td class="text-center">{{ __('asd') }}</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection