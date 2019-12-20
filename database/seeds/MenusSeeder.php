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
	            'name' => 'Nasi Goreng',
                'description' => 'lorem ipsum dolor sit amet bla bla bla bla bla blablabla bla',
                'price' => 10000,
                'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSTX80vgg6_6gwliroivmk4Vtqx3p11E1XC4Qb-hVyg6YIag-DD',
                'stock' => 99,
                'status' => 'Available',
            ]);
            //php artisan db:seed --class=MenusSeeder
            }
    }
}
