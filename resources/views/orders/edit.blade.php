@extends('layouts.app')

@section('title')
    a
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12">
                <div class="table-responsive">
                    <form action="{{ route('orders.update', $order->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="menu" value="{{ $order->menu_id }}">
                        <table class="table table-bordered shadow-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order->menu->name }}</td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm @error('quantity') is-invalid @enderror" name="quantity" value="{{ $order->quantity }}">
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('orders.index') }}" class="btn btn-sm btn-danger mx-1">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-success mx-1">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection