<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'username' => 'required|min:5|regex:[^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$]|unique:users',
            'email' => 'required|min:13|email|unique:users',
            'phone' => 'required|digits_between:10,13|numeric|unique:users',
            'address' => 'required|min:7|string',
            'gender' => 'required|in:Female,Male',
            // 'level' => 'required|in:Owner,Admin,Cashier,Waiter,Customer',
            // 'status' => 'required|in:Active,Nonactive',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => ucwords($data['name']), //uppercase for each word
            'username' => strtolower($data['username']), //lowercase for each word
            'email' => strtolower($data['email']), //lowercase for each word
            'phone' => $data['phone'],
            'address' => ucwords($data['address']), //uppercase for each word
            'gender' => ucwords($data['gender']),
            'level' => 'Customer',
            'status' => 'Active',
            'password' => Hash::make($data['password']),
        ]);
    }
}
