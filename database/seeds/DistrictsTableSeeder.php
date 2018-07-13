<?php

use Illuminate\Database\Seeder;
use App\District;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $districts = [
            ['id' => '1', 'name' => 'Rukungiri', 'sub_region'=> 'west_3', 'region' => 'west'],
            ['id' => '2', 'name' => 'Kanungu', 'sub_region'=> 'west_3', 'region' => 'west'],
            ['id' => '3', 'name' => 'Kabale', 'sub_region'=> 'west_3', 'region' => 'west'],
            ['id' => '4', 'name' => 'Mbarara', 'sub_region'=> 'west_2', 'region' => 'west'],
            ['id' => '5', 'name' => 'Bushenyi', 'sub_region'=> 'west_2', 'region' => 'west'],
            ['id' => '6', 'name' => 'Ntungamo', 'sub_region'=> 'west_2', 'region' => 'west'],
            ['id' => '8', 'name' => 'Kibale', 'sub_region'=> 'west_1', 'region' => 'west'],
            ['id' => '9', 'name' => 'Isingiro', 'sub_region'=> 'west_2', 'region' => 'west'],
            ['id' => '10', 'name' => 'Mitooma', 'sub_region'=> 'west_2', 'region' => 'west'],
            ['id' => '11', 'name' => 'Kamwenge', 'sub_region'=> 'west_3', 'region' => 'west'],
            ['id' => '12', 'name' => 'Rubirizi', 'sub_region'=> 'west_2', 'region' => 'west'],
            ['id' => '13', 'name' => 'Kirihura', 'sub_region'=> 'west_2', 'region' => 'west'],
            ['id' => '14', 'name' => 'Sheema', 'sub_region'=> 'west_2', 'region' => 'west'],
            ['id' => '15', 'name' => 'Buhweju', 'sub_region'=> 'west_2', 'region' => 'west'],
            ['id' => '16', 'name' => 'Kyegegwa', 'sub_region'=> 'west_1', 'region' => 'west'],
            ['id' => '17', 'name' => 'Kisoro', 'sub_region'=> 'west_3', 'region' => 'west'],
            ['id' => '18', 'name' => 'Kagadi', 'sub_region'=> 'west_1', 'region' => 'west'],
            ['id' => '19', 'name' => 'kamwengye', 'sub_region'=> 'west_1', 'region' => 'west'],
            ['id' => '20', 'name' => 'Kabarole', 'sub_region'=> 'west_1', 'region' => 'west'],
            ['id' => '21', 'name' => 'Kyenjojo', 'sub_region'=> 'west_1', 'region' => 'west']
        ];

        foreach ($districts as $district):
            District::firstOrCreate([
                "id" => $district['id'],
                "name" => $district['name'],
                "sub_region" => $district['sub_region'],
                "region" => $district['region']
            ]);
        endforeach;
    }
}
