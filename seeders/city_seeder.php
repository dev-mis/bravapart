<?php

declare(strict_types=1);

use App\Model\City;
use App\Model\District;
use App\Model\PostalCode;
use Hyperf\Database\Seeders\Seeder;
use App\Model\Province;
use App\Model\Village;

class CitySeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(asset('frontend/city.json'));

        $data = json_decode($json, true);

        City::truncate();
        District::truncate();
        Village::truncate();
        PostalCode::truncate();
        foreach($data['RECORDS'] as $key => $val){
            $province = Province::where('province_name', $val['province_name'])->first();

            City::insert([
                'province_id' => $province->id,
                'city_name' => $val['city_name']
            ]);
        }
    }
}
