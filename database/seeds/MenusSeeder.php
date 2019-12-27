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
	        DB::table('menus')->insert([
	            'name' => 'Nasi Goreng',
                'description' => 'Nasi goreng adalah sebuah makanan berupa nasi yang digoreng dan diaduk dalam minyak goreng atau margarin, biasanya ditambah kecap manis, bawang merah, bawang putih, asam jawa, lada dan bumbu-bumbu lainnya, seperti telur, ayam, dan kerupuk.',
                'price' => 12000,
                'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRLvXYXsRCdp_dzzArbON6jl94LXnFw5qa1CWBHw9YPiqvqNwIl',
                'stock' => 99,
                'status' => 'Available',
            ]);
            DB::table('menus')->insert([
	            'name' => 'Ayam Goreng',
                'description' => 'Ayam goreng Nusantara adalah hidangan Asia Tenggara yang merupakan ayam yang digoreng dalam minyak goreng. Dalam dunia internasional, istilah ayam goreng merujuk kepada ayam goreng gaya Nusantara.',
                'price' => 7000,
                'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRlvKNW2zD499zD07wjjbswL4CTes8BR9ChlECDTzgQXoEsz3nR',
                'stock' => 99,
                'status' => 'Available',
            ]);
            DB::table('menus')->insert([
	            'name' => 'Ayam Goreng',
                'description' => 'Ayam goreng Nusantara adalah hidangan Asia Tenggara yang merupakan ayam yang digoreng dalam minyak goreng. Dalam dunia internasional, istilah ayam goreng merujuk kepada ayam goreng gaya Nusantara.',
                'price' => 7000,
                'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRlvKNW2zD499zD07wjjbswL4CTes8BR9ChlECDTzgQXoEsz3nR',
                'stock' => 99,
                'status' => 'Available',
            ]);
            //php artisan db:seed --class=MenusSeeder
    }
}
