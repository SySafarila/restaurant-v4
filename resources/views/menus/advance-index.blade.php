@extends('layouts.app')

@section('title', '| Advance Menus')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
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
                            <td class="align-middle"><a href="{{ route('menus.show', $menu->id) }}" class="text-decoration-none text-orange">{{ $menu->name }}</a> <br> <span class="badge badge-success badge-pill align-middle">Rp.{{ $menu->price }}</span> <span class="badge badge-primary badge-pill align-middle">Stock : {{ $menu->stock }}</span></td>
                            <td class="text-center align-middle">
                                <form action="{{ route('menus.destroy', $menu->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
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