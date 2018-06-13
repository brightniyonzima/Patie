<?php

use Illuminate\Database\Seeder;
use App\HealthUnit;

class HealthUnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HealthUnit::firstOrCreate(['name'=>'Test Hospital','location'=>'2','created_by'=>'brightniyonzima@gmail.com']);
    }
}
