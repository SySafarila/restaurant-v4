@extends('layouts.app')

@section('title', '| Notification')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-0"><a href="{{ route('notifications.index') }}" class="text-success text-decoration-none">Notification</a></h3>
                        <hr class="hr">
                        <p class="mb-0">{!! $notification->message !!}</p>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection