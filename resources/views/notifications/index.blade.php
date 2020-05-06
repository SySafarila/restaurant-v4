@extends('layouts.app')

@section('title', '| Notifications')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-0">Notifications</h3>
                    <a href="{{ route('notifications.clear') }}" class="pt-1 text-decoration-none" onclick="event.preventDefault();document.getElementById('clearNotifications').submit();">Clear</a>
                </div>
                <form id="clearNotifications" action="{{ route('notifications.clear') }}" method="post" class="d-none">
                    @csrf
                    @method('PATCH')
                </form>
                <hr class="hr">
                <ul class="list-group">
                    @foreach ($notifications as $notif)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-1 align-self-center">
                                <span class="material-icons align-middle mb-1 @if($notif->status == true) text-success @else text-orange @endif">@if($notif->status == false) fiber_manual_record @else done_all @endif</span>
                            </div>
                            <div class="col">
                                <a href="{{ route('notifications.show', $notif->id) }}" class="text-decoration-none text-dark stretched-link">{!! $notif->message !!}</a>
                                <small class="d-block text-muted">{{ $notif->created_at->diffForHumans() }} @if($notif->status == false) | <span class="text-orange">Unread</span> @endif</small>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @if ($notifications->count() == 0)
                        <h3 class="text-center text-muted">EMPTY</h3>
                    @endif
                </ul>
                <div class="d-flex mt-3">
                    <div class="mx-auto">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection