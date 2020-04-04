@extends('layouts.app')

@section('title')
    | Invoices
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
        @if (session('status_warning'))
            <div class="row justify-content-center">
                <div class="col-md-9 col-sm-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('status_warning') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-9 col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover shadow-sm">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="align-middle">Invoices</th>
                                <th class="text-center align-middle">Total (Rp)</th>
                                @if (Auth::user()->level == 'Admin')
                                    <th class="align-middle">Username</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td class="text-center align-middle">{{ $nomor++ }}</td>
                                    <td class="align-middle"><a href="{{ route('invoices.show', $invoice->id)}}">{{ $invoice->code }}</a></td>
                                    <td class="text-center align-middle font-weight-bold text-success">{{ number_format($invoice->invoices->sum('total'), 0, 0, '.') }}</td>
                                    @if (Auth::user()->level == 'Admin')
                                        <td class="align-middle"><a href="{{ route('users.show', $invoice->user->username) }}" class="text-orange text-decoration-none">{{'@' . $invoice->user->username }}</a></td>
                                    @endif
                                </tr>
                            @endforeach
                            @if ($invoices->count() == 0)
                                <tr>
                                    <th colspan="4" class="text-center text-danger">Empty</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{-- @if (Auth::user()->level == 'Admin') --}}
                        <div class="d-flex">
                            <div class="mx-auto">{{ $invoices->links() }}</div>
                        </div>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>
@endsection