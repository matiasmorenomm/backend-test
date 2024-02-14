<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use App\Models\Region;
use App\Models\Street;
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
        // \App\Models\User::factory(10)->create();

        $region = new Region();
        $region->name = 'METROPOLITANA';
        $region->save();

        $region2 = new Region();
        $region2->name = 'BIO BIO';
        $region2->save();

        $region3 = new Region();
        $region3->name = 'MAULE';
        $region3->save();

        $province = new Province();
        $province->name = 'BIOBIO';
        $province->region_id = 2;
        $province->save();

        $province2 = new Province();
        $province2->name = 'CONCEPCION';
        $province2->region_id = 1;
        $province2->save();

        $city = new City();
        $city->name = 'LOS ANGELES';
        $city->province_id = 1;
        $city->save();

        $city2 = new City();
        $city2->name = 'MULCHEN';
        $city2->province_id = 2;
        $city2->save();

        $city3 = new City();
        $city3->name = 'NACIMIENTO';
        $city3->province_id = 1;
        $city3->save();

        $city4 = new City();
        $city4->name = 'LAJA';
        $city4->province_id = 2;
        $city4->save();

        $city5 = new City();
        $city5->name = 'ANTUCO';
        $city5->province_id = 1;
        $city5->save();

        $street = new Street();
        $street->name = '21 DE MAYO';
        $street->city_id = 1;
        $street->save();

        $street2 = new Street();
        $street2->name = 'BAQUEDANO';
        $street2->city_id = 1;
        $street2->save();

        $street3 = new Street();
        $street3->name = 'ARTURO PRAT';
        $street3->city_id = 2;
        $street3->save();

        $street4 = new Street();
        $street4->name = 'CARRERA';
        $street4->city_id = 3;
        $street4->save();

        $street5 = new Street();
        $street5->name = 'CRUZ';
        $street5->city_id = 4;
        $street5->save();
    }
}
