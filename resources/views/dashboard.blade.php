@extends('layouts.app')

@section('title')
    | Dashboard - {{ Auth::user()->level }}
@endsection

@section('content')
<div class="container">
    @if (session('status-redirect'))
        <div class="row justify-content-center">
            <div class="col">
                <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                    {{ session('status-redirect') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    <div class="row justify-content-center">
        <x-dashboard.owner />
        <x-dashboard.admin />
        <x-dashboard.cashier />
        <x-dashboard.customer />
        <x-dashboard.chef />
    </div>
</div>
@endsection
