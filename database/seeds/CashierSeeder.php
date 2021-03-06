<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CashierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Cashier',
            'username' => 'cashier',
            'email' => 'cashier@gmail.com',
            'phone' => '082100000123',
            'address' => 'Sillicon Valley, Internet',
            'gender' => 'Male',
            'level' => 'Cashier',
            'status' => 'Active',
            'created_at' => Carbon::now(),
            'password' => Hash::make('password'),
        ]);
        // php artisan db:seed --class=CashierSeeder
    }
}
