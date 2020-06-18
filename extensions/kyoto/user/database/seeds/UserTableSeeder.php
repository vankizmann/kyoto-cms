<?php

use Illuminate\Database\Seeder;
use Kyoto\User\Models\User;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        $admin = User::create([
            'id'       => uuid(),
            'state'    => 1,
            'name'     => env('KYO_USERNAME', 'admin'),
            'email'    => env('KYO_EMAIL', 'admin@email.com'),
            'password' => env('KYO_PASSWORD', 'password')
        ]);
    }

}
