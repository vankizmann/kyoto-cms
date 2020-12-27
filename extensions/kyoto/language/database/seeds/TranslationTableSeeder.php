<?php

use Illuminate\Database\Seeder;
use Kyoto\Language\Models\Translation;

class TranslationTableSeeder extends Seeder
{

    public function run()
    {
        $demo = Translation::create([
            'id'        => uuid(),
            'state'     => 1,
            'source'    => 'Demotranslation',
            'target'    => 'Demotranslation',
        ]);

        $demo->localized('de')->update([
            'target'      => 'Demoübersetzung',
        ]);

    }

}
