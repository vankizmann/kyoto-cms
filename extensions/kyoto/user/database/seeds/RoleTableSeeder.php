<?php

use Illuminate\Database\Seeder;
use Kyoto\User\Models\Policy;
use Kyoto\User\Models\Role;
use Kyoto\User\Models\User;

class RoleTableSeeder extends Seeder
{

    public function run()
    {
        $admin = Role::create([
            'id'          => uuid(),
            'title'       => 'Administrator',
            'description' => 'A description for administrator',
        ]);

        $admin->policies()->attach(Policy::all());

        $admin->users()->attach(User::first());

        $manager = Role::create([
            'id'          => uuid(),
            'title'       => 'Manager',
            'description' => 'A description for manager',
            'parent'      => $admin
        ]);
    }

}
