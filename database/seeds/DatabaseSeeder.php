<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(MenusSeeder::class);
        $this->call(CashierSeeder::class);
        $this->call(WaiterSeeder::class);
    }
}
