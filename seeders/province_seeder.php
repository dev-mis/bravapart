<?php

declare(strict_types=1);

use App\Model\City;
use App\Model\District;
use App\Model\PostalCode;
use Hyperf\Database\Seeders\Seeder;
use App\Model\Province;
use App\Model\Village;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(asset('frontend/province.json'));

        $data = json_decode($json, true);

        Province::truncate();
        City::truncate();
        District::truncate();
        Village::truncate();
        PostalCode::truncate();
        foreach($data['RECORDS'] as $key => $val){
            Province::insert([
                'province_name' => $val['province_name']
            ]);
        }
    }
}
