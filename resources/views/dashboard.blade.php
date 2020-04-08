@extends($layout)

{{-- @section('title', '| Dashboard') --}}

@section('title')
    | Dashboard - {{ Auth::user()->level }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('status-redirect'))
            <div class="col">
                <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                    {{ session('status-redirect') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
        @if (Auth::user()->status == 'Active')
            @if (Auth::user()->level == 'Owner')
            {{-- OWNER PAGE --}}
                <x-dashboard.owner />
            @else
                @if (Auth::user()->level == 'Admin')
                {{-- ADMIN PAGE --}}
                <x-dashboard.admin />
                @else
                    @if (Auth::user()->level == 'Cashier')
                    {{-- CASHIER PAGE --}}
                        <x-dashboard.cashier />
                    @else
                        @if (Auth::user()->level == 'Waiter')
                        {{-- WAITER PAGE --}}
                            Hi Waiter
                        @else
                            @if (Auth::user()->level == 'Customer')
                            {{-- CUSTOMER PAGE --}}
                                <x-dashboard.customer />
                            @endif
                        @endif
                    @endif
                @endif
            @endif
        @else
            Hi <b>{{ Auth::user()->name }}</b>, You're nonactive as <b>{{ Auth::user()->level }}</b>
        @endif
    </div>
</div>
@endsection
