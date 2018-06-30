<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CountiesTableSeeder::class);
        $this->call(SubCountiesTableSeeder::class);
        $this->call(ParishesTableSeeder::class);
        $this->call(VillagesTableSeeder::class);
    }
}
