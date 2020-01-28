@extends('layouts.app')

@section('title', '| Advance Menus')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="action mb-1 float-right">
                    <a href="{{ route('menus.deleted') }}" class="material-icons text-orange text-decoration-none" style="font-size:30px;">restore_from_trash</a>
                    <a href="{{ route('menus.create') }}" class="material-icons text-success text-decoration-none" style="font-size:30px;">add_box</a>
                </div>
                <table class="table table-bordered table-hover shadow-sm">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>Menus</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                        <tr>
                            <td class="text-center align-middle" style="width: 60px;">{{ $number++ }}</td>
                            <td class="align-middle"><a href="{{ route('menus.show', $menu->id) }}" class="text-decoration-none text-orange">{{ $menu->name }}</a> <br> <span class="badge badge-success badge-pill align-middle">Rp.{{ number_format($menu->price,0 ,0, '.') }}</span> <span class="badge badge-orange badge-pill align-middle">Stock : {{ $menu->stock }}</span></td>
                            <td class="text-center align-middle">
                                <form action="{{ route('menus.destroy', $menu->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('menus.edit', $menu->id) }}" class="my-1 btn btn-sm btn-success material-icons">edit</a>
                                    <button class="my-1 btn btn-sm btn-outline-danger material-icons">delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="text-center font-weight-bold">Total Available Stock</td>
                            <td class="text-center font-weight-bold text-orange">{{ $menus->sum('stock') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection