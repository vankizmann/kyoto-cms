<?php

use Illuminate\Database\Seeder;
use Kyoto\User\Models\Policy;

class PolicyTableSeeder extends Seeder
{

    public function run()
    {
        Policy::create([
            'title'  => 'Access all extensions',
            'type'   => 'extension',
            'action' => '*',
        ]);

    }

}
