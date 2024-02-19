<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;
use App\Model\District;
use App\Model\Village;
use App\Model\Province;
use App\Model\City;
use App\Model\PostalCode;

class VillageSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(asset('frontend/village.json'));

        $data = json_decode($json, true);

        Village::truncate();
        PostalCode::truncate();
        foreach($data['RECORDS'] as $key => $val){
            $province = Province::where('province_name', $val['province_name'])->first();
            $city = City::where('city_name', $val['city_name'])->where('province_id', $province->id)->first();
            $district = District::where('city_id', $city->id)->where('district_name', $val['district_name'])->first();

            Village::insert([
                'district_id' => $district->id,
                'village_name' => $val['village_name']
            ]);
        }
    }
}