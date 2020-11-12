<?php

use Illuminate\Database\Seeder;
use Kyoto\Package\Models\Package;

class PackageTableSeeder extends Seeder
{

    public function run()
    {
        Package::create([
            'id'        => uuid(),
            'state'     => 1,
            'lock'      => 1,
            'name'      => 'kyoto/installer',
        ]);

        Package::create([
            'id'        => uuid(),
            'state'     => 1,
            'lock'      => 1,
            'name'      => 'kyoto/package',
        ]);

        Package::create([
            'id'        => uuid(),
            'state'     => 1,
            'lock'      => 1,
            'name'      => 'kyoto/language',
        ]);

        Package::create([
            'id'        => uuid(),
            'state'     => 1,
            'lock'      => 1,
            'name'      => 'kyoto/user',
        ]);

        Package::create([
            'id'        => uuid(),
            'state'     => 1,
            'lock'      => 1,
            'name'      => 'kyoto/menu',
        ]);

        Package::create([
            'id'        => uuid(),
            'state'     => 1,
            'lock'      => 1,
            'name'      => 'kyoto/media',
        ]);

        Package::create([
            'id'        => uuid(),
            'state'     => 1,
            'lock'      => 1,
            'name'      => 'kyoto/page',
        ]);

        Package::create([
            'id'        => uuid(),
            'state'     => 1,
            'lock'      => 0,
            'name'      => 'kyoto/backend',
        ]);

        Package::create([
            'id'        => uuid(),
            'state'     => 1,
            'lock'      => 0,
            'name'      => 'kyoto/frontend',
        ]);
    }

}
