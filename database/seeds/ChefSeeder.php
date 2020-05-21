<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'chef',
            'username' => 'chef',
            'email' => 'chef@gmail.com',
            'phone' => '082100120123',
            'address' => 'Sillicon Valley, Internet',
            'gender' => 'Male',
            'level' => 'Chef',
            'status' => 'Active',
            'created_at' => Carbon::now(),
            'password' => Hash::make('chef'),
        ]);
        // php artisan db:seed --class=ChefSeeder
    }
}
