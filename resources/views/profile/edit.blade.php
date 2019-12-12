@extends('layouts.app')

@section('title', '| Profile - Edit')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body table-responsive">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2" class="text-center">Profile</td>
                            </tr>
                            <tr>
                                <td class="align-middle">Name</td>
                                <td class="text-capitalize">
                                    <input id="name" type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">Username</td>
                                <td class="text-lowecase">
                                    {{-- <input id="username" type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus> --}}
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">@</div>
                                        </div>
                                        <input id="username" type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>
                                    </div>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">Email</td>
                                <td class="text-lowecase">
                                    <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror mt-1" name="email" value="{{ $user->email }}" disabled autocomplete="email" autofocus>
                                    <small class="form-text">
                                        <a href="{{ route('profile.editlogin') }}" class="text-decoration-none text-danger">* Click here to edit Your email</a>
                                    </small>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">Phone</td>
                                <td>
                                    <input id="phone" type="number" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone" autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">Address</td>
                                <td class="text-capitalize">
                                    <textarea id="address" class="form-control form-control-sm @error('address') is-invalid @enderror" name="address" value="{{ $user->address }}" required autocomplete="address" autofocus>{{ $user->address }}</textarea>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">Gender</td>
                                <td class="text-capitalize">
                                    <select id="gender" class="form-control form-control-sm @error('gender') is-invalid @enderror" name="gender" value="{{ $user->gender }}" required autocomplete="gender" autofocus>
                                        <option value="{{ $user->gender }}" selected>{{ $user->gender }} ( Default )</option>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                    </select>

                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">Level</td>
                                <td class="text-capitalize">
                                    <select class="form-control form-control-sm @error('level') is-invalid @enderror" name="level" value="{{ $user->level }}" disabled autocomplete="level" autofocus>
                                        <option value="{{ $user->level }}" selected>You can't edit this field</option>
                                        <option value="Owner">Owner</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Cashier">Cashier</option>
                                        <option value="Waiter">Waiter</option>
                                        <option value="Customer">Customer</option>
                                    </select>
                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">Status</td>
                                <td class="text-capitalize">
                                    <select class="form-control form-control-sm @error('status') is-invalid @enderror" name="status" value="{{ $user->status }}" disabled autocomplete="status" autofocus>
                                        <option value="{{ $user->status }}" selected>You can't edit this field</option>
                                        <option value="Active">Active</option>
                                        <option value="Nonactive">Nonactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('profile.index') }}" class="btn btn-sm btn-danger mx-1">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-outline-success mx-1">Edit Profile</button>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('profile.editlogin')}}" class="text-decoration-none">Change Login Information</a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection