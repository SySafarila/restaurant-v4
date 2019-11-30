<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Syahrul Safarila',
            'username' => 'sysafarila',
            'email' => 'sysafarila@gmail.com',
            'phone' => '082117694132',
            'address' => 'Cianjur, Warungkondang, Bunikasih',
            'gender' => 'male',
            'level' => 'admin',
            'status' => 'active',
            'password' => Hash::make('08052001'),
        ]);
        //php artisan db:seed --class=UsersTableSeeder
    }
}
