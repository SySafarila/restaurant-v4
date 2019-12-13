<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,20) as $index)
        {
	        DB::table('menus')->insert([
	            'name' => $faker->text($maxNbChars = 20),
                'description' => $faker->text($maxNbChars = 100),
                'price' => 10000,
                'img' => $faker->imageUrl($width = 640, $height = 480),
                'stock' => 99,
                'status' => 'Available',
            ]);
            //php artisan db:seed --class=MenusSeeder
            }
    }
}
