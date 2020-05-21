@extends('layouts.app')

@section('title')
    | Kitchen
@endsection

@section('content')
    <div class="container">
        <x-alert />
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h4>Pending</h4>
                        <hr>
                        @foreach ($orders->where('status', 'Pending') as $pending)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p class="font-weight-bold m-0">{{ $pending->menu }}</p>
                                    <p class="m-0 text-muted">{{ $pending->code }} | {{ '@' . $pending->user->username }}</p>
                                    <div class="d-flex mt-1">
                                        <a href="{{ route('kitchen.cooking', $pending->id) }}" class="badge badge-success mr-1" onclick="event.preventDefault();document.getElementById('setCooking').submit();">Set to Cooking !</a>
                                        <span class="badge badge-danger mr-1">Set to Out of stock !</span>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('kitchen.cooking', $pending->id) }}" method="post" id="setCooking" class="d-none">
                                @csrf
                            </form>
                        @endforeach
                        @if ($orders->where('status', 'Pending')->count() == 0)
                            Empty
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h4>Cooking</h4>
                        <hr>
                        @foreach ($orders->where('status', 'Cooking') as $order)
                        <div class="card mb-3">
                            <div class="card-body">
                                <p class="font-weight-bold m-0">{{ $order->menu }}</p>
                                <p class="m-0 text-muted">{{ $order->code }} | {{ '@' . $order->user->username }}</p>
                                <div class="d-flex mt-1">
                                    <a href="#" class="badge badge-success mr-1">Set to Success !</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if ($orders->where('status', 'Cooking')->count() == 0)
                            Empty
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection