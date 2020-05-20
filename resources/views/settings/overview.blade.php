@extends('layouts.setting')

@section('title')
    | Setting
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row px-2">
            <div class="col-md-6 mb-3 px-2">
                <div class="card h-100 shadow-sm">
                    {{-- <a href="{{ route('setting.account') }}" class="stretched-link"></a> --}}
                    <div class="dropdown">
                        <a href="#" class="material-icons position-absolute text-decoration-none more-vert" id="dropdownProfile" data-toggle="dropdown" style="right: 0.5rem; top: 0.5rem;">more_vert</a>
                        <div class="dropdown-menu shadow-sm" aria-labelledby="dropdownProfile">
                            <a class="dropdown-item" href="{{ route('setting.account') }}">Edit</a>
                        </div>
                    </div>
                    <div class="card-body d-flex">
                        <div class="col-2 h-100 p-0 d-flex align-items-center">
                            @if ($user->img == null)
                                <img src="{{ asset('avatar.png') }}" alt="Avatar" class="rounded-circle w-100">
                            @else
                                <img src="{{ asset('storage/avatars/user/' . $user->img) }}" alt="Avatar" title="Avatar" class="rounded-circle w-100">
                            @endif
                        </div>
                        <div class="col-10 pr-0 d-flex align-items-center">
                            <div>
                                <div>
                                    <span class="font-weight-bold">Name : </span> {{ $user->name }}
                                </div>
                                <div>
                                    <span class="font-weight-bold">Username : </span> {{ $user->username }}
                                </div>
                                <div>
                                    <span class="font-weight-bold">Email : </span> {{ $user->email }}
                                </div>
                                <div>
                                    <span class="font-weight-bold">Level : </span> {{ $user->level }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3 px-2">
                <div class="card h-100 shadow-sm">
                    <a href="#" class="material-icons position-absolute text-decoration-none more-vert" style="right: 0.5rem; top: 0.5rem;">more_vert</a>
                    <div class="card-body">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis, nam amet voluptates provident iusto aperiam nemo eaque quae dolor accusantium magnam corporis quisquam, quia incidunt? Voluptatem officia ducimus quibusdam sunt!
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3 px-2">
                <div class="card h-100 shadow-sm">
                    <a href="#" class="material-icons position-absolute text-decoration-none more-vert" style="right: 0.5rem; top: 0.5rem;">more_vert</a>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi minima amet dolorem ipsam eligendi fugiat delectus ratione expedita culpa ut assumenda, dolor illum nihil cumque, sequi eaque hic! Deserunt, veniam?
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3 px-2">
                <div class="card h-100 shadow-sm">
                    <a href="#" class="material-icons position-absolute text-decoration-none more-vert" style="right: 0.5rem; top: 0.5rem;">more_vert</a>
                    <div class="card-body">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatum officiis tenetur perspiciatis exercitationem inventore veritatis deserunt odio vero eum omnis quos, assumenda beatae, minima aperiam sapiente maxime cum illum suscipit?
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection