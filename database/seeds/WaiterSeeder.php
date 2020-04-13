<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WaiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Waiter',
            'username' => 'waiter',
            'email' => 'waiter@gmail.com',
            'phone' => '092100000000',
            'address' => 'Sillicon Valley, Internet',
            'gender' => 'Male',
            'level' => 'Waiter',
            'status' => 'Active',
            'created_at' => Carbon::now(),
            'password' => Hash::make('waiter'),
        ]);
        //php artisan db:seed --class=WaiterSeeder
    }
}
