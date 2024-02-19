<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;
use App\Model\Bank;

class BankSeeder extends Seeder
{
    public function run()
    {
        Bank::truncate();
        
        $json = file_get_contents(asset('frontend/bank.json'));

        $data = json_decode($json, true);

        foreach($data as $bank){
            Bank::insert([
                'code' => $bank['bank_code'],
                'name' => $bank['bank_name']
            ]);
        }
    }
}
