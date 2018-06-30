<?php

use Illuminate\Database\Seeder;
use App\county;

class CountiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counties = [
            ['id' => '1', 'name' => 'Rubabo', 'district_id' => '1'],
            ['id' => '2', 'name' => 'Rujumbura', 'district_id' => '1'],
            ['id' => '3', 'name' => 'Rukungiri Municipality', 'district_id' => '1'],
            ['id' => '4', 'name' => 'Kajara', 'district_id' => '6'],
            ['id' => '5', 'name' => 'Ruhaama', 'district_id' => '6'],
            ['id' => '6', 'name' => 'Rushenyi', 'district_id' => '6'],
            ['id' => '7', 'name' => 'Ntungamo Municipality', 'district_id' => '6'],
            ['id' => '8', 'name' => 'Rukiga', 'district_id' => '3'],
            ['id' => '9', 'name' => 'Kabale Municipality', 'district_id' => '3'],
            ['id' => '10', 'name' => 'Rubanda', 'district_id' => '3'],
            ['id' => '11', 'name' => 'Ndorwa', 'district_id' => '3'],
            ['id' => '12', 'name' => 'Kinkiizi', 'district_id' => '2'],
            ['id' => '13', 'name' => 'RUSHENYI', 'district_id' => '6'],
            ['id' => '14', 'name' => 'Rutenga', 'district_id' => '2'],
            ['id' => '15', 'name' => 'kinkizi', 'district_id' => '8'],
            ['id' => '16', 'name' => 'kayungwe', 'district_id' => '8'],
            ['id' => '17', 'name' => 'Rub abo', 'district_id' => '5'],
            ['id' => '18', 'name' => 'IBALE', 'district_id' => '5'],
            ['id' => '19', 'name' => 'Bushenyi Municipality', 'district_id' => '5'],
            ['id' => '20', 'name' => 'Bukanga', 'district_id' => '9'],
            ['id' => '21', 'name' => 'RUHINDA', 'district_id' => '10'],
            ['id' => '22', 'name' => 'KASHAMBYA', 'district_id' => '3'],
            ['id' => '23', 'name' => 'kabira', 'district_id' => '10'],
            ['id' => '24', 'name' => 'Rugarama', 'district_id' => '6'],
            ['id' => '25', 'name' => 'RUREHE', 'district_id' => '10'],
            ['id' => '26', 'name' => 'Kibale South', 'district_id' => '11'],
            ['id' => '27', 'name' => 'Test Sub County', 'district_id' => '12'],
            ['id' => '28', 'name' => 'RUJUMBURA', 'district_id' => '14'],
            ['id' => '29', 'name' => 'Rukinga', 'district_id' => '3'],
            ['id' => '30', 'name' => 'Kibale East', 'district_id' => '11'],
            ['id' => '31', 'name' => 'Rwampara', 'district_id' => '4'],
            ['id' => '32', 'name' => 'Isingiro', 'district_id' => '9'],
            ['id' => '33', 'name' => 'Kabura', 'district_id' => '15'],
            ['id' => '34', 'name' => 'Entebbe', 'district_id' => '16'],
            ['id' => '35', 'name' => 'Ruhama', 'district_id' => '18'],
            ['id' => '36', 'name' => 'Kitwe', 'district_id' => '18'],
            ['id' => '37', 'name' => 'Nsiika', 'district_id' => '19'],
            ['id' => '38', 'name' => 'Migamba', 'district_id' => '20'],
            ['id' => '39', 'name' => 'Kyaka', 'district_id' => '20'],
            ['id' => '40', 'name' => 'Kashongi', 'district_id' => '13'],
            ['id' => '41', 'name' => 'Kazo', 'district_id' => '13'],
            ['id' => '42', 'name' => 'BUFUMBIRA SOUTH', 'district_id' => '21'],
            ['id' => '43', 'name' => 'kanshagama', 'district_id' => '15'],
            ['id' => '44', 'name' => 'kabula', 'district_id' => '15'],
            ['id' => '45', 'name' => 'Kashari', 'district_id' => '4'],
            ['id' => '46', 'name' => 'Buwekura', 'district_id' => '23'],
            ['id' => '47', 'name' => 'Mahogola', 'district_id' => '25'],
            ['id' => '48', 'name' => 'Rubanda', 'district_id' => '26'],
            ['id' => '49', 'name' => 'Ibanda', 'district_id' => '27'],
            ['id' => '50', 'name' => 'Sheema', 'district_id' => '14'],
            ['id' => '51', 'name' => 'Bunyaruguru', 'district_id' => '5'],
            ['id' => '52', 'name' => 'Buyaga West', 'district_id' => '29'],
            ['id' => '53', 'name' => 'Buyaruguru', 'district_id' => '12'],
            ['id' => '54', 'name' => 'Buyaruguru', 'district_id' => '12'],
            ['id' => '55', 'name' => 'Buyaruguru', 'district_id' => '12'],
            ['id' => '56', 'name' => 'Buyaruguru', 'district_id' => '12'],
            ['id' => '57', 'name' => 'Bunyaruguru', 'district_id' => '12'],
            ['id' => '58', 'name' => 'Bukinda', 'district_id' => '3'],
            ['id' => '59', 'name' => 'Rwamucucu', 'district_id' => '3'],
            ['id' => '60', 'name' => 'Rwasamere', 'district_id' => '6'],
            ['id' => '61', 'name' => 'Rwashamere', 'district_id' => '6'],
            ['id' => '62', 'name' => 'Buyaga west', 'district_id' => '8'],
            ['id' => '63', 'name' => 'Byeru', 'district_id' => '12'],
            ['id' => '64', 'name' => 'Ryeru', 'district_id' => '12'],
            ['id' => '65', 'name' => 'Mbarara Municipality', 'district_id' => '4'],
            ['id' => '66', 'name' => 'Kooki', 'district_id' => '31'],
            ['id' => '67', 'name' => 'Mushunga', 'district_id' => '10'],
            ['id' => '68', 'name' => 'Sheema North', 'district_id' => '14'],
            ['id' => '69', 'name' => 'Rwemiyaga', 'district_id' => '25'],
            ['id' => '70', 'name' => 'rubanda', 'district_id' => '8'],
            ['id' => '71', 'name' => 'Kakabara', 'district_id' => '20'],
            ['id' => '72', 'name' => 'Igaara', 'district_id' => '5'],
            ['id' => '73', 'name' => 'Ruheija', 'district_id' => '26'],
            ['id' => '74', 'name' => 'Mahogora', 'district_id' => '25'],
            ['id' => '75', 'name' => 'Northern Division', 'district_id' => '21'],
            ['id' => '76', 'name' => 'Eitah', 'district_id' => '11'],
            ['id' => '77', 'name' => 'Eitaha', 'district_id' => '11'],
            ['id' => '78', 'name' => 'kitagwenda', 'district_id' => '11'],
            ['id' => '79', 'name' => 'Mwenge', 'district_id' => '33'],
            ['id' => '80', 'name' => 'Ruabaga', 'district_id' => '34'],
            ['id' => '81', 'name' => 'Erute South', 'district_id' => '35'],
            ['id' => '82', 'name' => 'Bufimbira North', 'district_id' => '21'],
            ['id' => '83', 'name' => 'Lyantonde', 'district_id' => '15'],
            ['id' => '84', 'name' => 'Kasambya', 'district_id' => '23'],
            ['id' => '85', 'name' => 'Katerera', 'district_id' => '12'],
            ['id' => '86', 'name' => 'Bufumbira East', 'district_id' => '21'],
            ['id' => '87', 'name' => 'Burahya', 'district_id' => '32'],
            ['id' => '88', 'name' => 'Nakyenyi', 'district_id' => '37'],
            ['id' => '89', 'name' => 'kazo', 'district_id' => '39'],
            ['id' => '90', 'name' => 'Busiro', 'district_id' => '16'],
            ['id' => '91', 'name' => 'Bugangeizi West', 'district_id' => '40'],
            ['id' => '92', 'name' => 'Kibale', 'district_id' => '11'],
            ['id' => '93', 'name' => 'Buhweju', 'district_id' => '19'],
            ['id' => '94', 'name' => 'Bunyangaro', 'district_id' => '32'],
            ['id' => '95', 'name' => 'Nyabushozi', 'district_id' => '39'],
            ['id' => '96', 'name' => 'Nyabushozi', 'district_id' => '13'],
            ['id' => '97', 'name' => 'Buyanja', 'district_id' => '1'],
            ['id' => '98', 'name' => 'Bufumbira', 'district_id' => '21'],
            ['id' => '99', 'name' => 'Kawempe', 'district_id' => '34'],
            ['id' => '100', 'name' => 'Rutete', 'district_id' => '29'],
            ['id' => '101', 'name' => 'Mirongo', 'district_id' => '4'],
            ['id' => '102', 'name' => 'Mutara', 'district_id' => '10'],
            ['id' => '103', 'name' => 'kyamuhunga', 'district_id' => '5']
        ];

        foreach ($counties as $county):

            county::firstOrCreate([
                "id" => $county['id'],
                "name" => $county['name'],
                "district_id" => $county['district_id']
            ]);

        endforeach;
    }
}
