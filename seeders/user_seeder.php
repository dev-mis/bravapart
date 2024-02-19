<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;
use App\Model\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Revan Pratama',
            'email' => 'revan.pratama@modena.com',
            'phone' => '087720814826',
            'password' => hash('sha256', '123456'),
            'is_active' => true,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
