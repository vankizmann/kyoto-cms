<?php

use Illuminate\Database\Seeder;
use Kyoto\User\Models\Gate;
use Kyoto\User\Models\User;

class GateTableSeeder extends Seeder
{

    public function run()
    {
        $admin = Gate::create([
            'id'          => uuid(),
            'title'       => 'Administrator',
            'description' => 'A description for administrator',
        ]);

        $admin->users()->save(User::first());


        $manager = Gate::create([
            'id'          => env('KYO_GUARD'),
            'title'       => 'Manager',
            'description' => 'A description for manager',
            'parent'      => $admin
        ]);
    }

}
