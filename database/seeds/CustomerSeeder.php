<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Customer',
            'username' => 'customer',
            'email' => 'customer@gmail.com',
            'phone' => '082100000001',
            'address' => 'Sillicon Valley, Internet',
            'gender' => 'Male',
            'level' => 'Customer',
            'status' => 'Active',
            'created_at' => Carbon::now(),
            'password' => Hash::make('customer'),
        ]);
        //php artisan db:seed --class=CustomerSeeder
    }
}
