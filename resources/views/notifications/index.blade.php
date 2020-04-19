@extends('layouts.app')

@section('title', '| Notifications')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="mb-0">Notifications</h3>
                <hr class="hr">
                <ul class="list-group">
                    @foreach ($notifications as $notif)
                    <li class="list-group-item @if($notif->status == false) bg-warning @endif">
                        <div class="row">
                            <div class="col-1 align-self-center">
                                <span class="material-icons align-middle mb-1 @if($notif->status == true) text-success @endif">@if($notif->status == false) info @else done_all @endif</span>
                            </div>
                            <div class="col"><a href="{{ route('notifications.show', $notif->id) }}" class="text-decoration-none text-dark stretched-link">{!! $notif->message !!}</a></div>
                        </div>
                    </li>
                    @endforeach
                    @if ($notifications->count() == 0)
                        <h3 class="text-center text-muted">EMPTY</h3>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection