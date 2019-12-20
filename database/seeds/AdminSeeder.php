<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '082100000000',
            'address' => 'Sillicon Valley, Internet',
            'gender' => 'Male',
            'level' => 'Admin',
            'status' => 'Active',
            'password' => Hash::make('admin'),
        ]);
        //php artisan db:seed --class=AdminSeeder
    }
}
