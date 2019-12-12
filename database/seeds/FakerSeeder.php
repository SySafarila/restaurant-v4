<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,100) as $index)
        {
	        DB::table('users')->insert([
	            'name' => $faker->name,
                'username' => $faker->userName,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'gender' => 'Male',
                'level' => 'Customer',
                'status' => 'Active',
                'password' => Hash::make('08052001'),
            ]);
            //php artisan db:seed --class=FakerSeeder
	    }
    }
}
