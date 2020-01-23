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
                            <th class="text-center">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                        <tr>
                            <td class="text-center align-middle" style="width: 60px;">{{ $number++ }}</td>
                            <td class="align-middle">{{ $menu->name }} <br> <span class="badge badge-success badge-pill align-middle">Rp.{{ $menu->price }}</span></td>
                            <td class="text-center align-middle">{{ $menu->stock }}</td>
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