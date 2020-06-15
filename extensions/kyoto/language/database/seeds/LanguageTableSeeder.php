<?php

use Illuminate\Database\Seeder;
use Kyoto\Language\Models\Language;

class LanguageTableSeeder extends Seeder
{

    public function run()
    {
        $en = Language::create([
            'id'        => uuid(),
            'state'     => 1,
            'hide'      => 0,
            'country'   => 'United Kingdom',
            'language'  => 'English',
            'locale'    => 'en',
            'plate'     => 'gb',
        ]);

        $en->localized('de')->update([
            'language'      => 'Englisch',
            'country'       => 'Vereinigtes Königreich',
        ]);

        $de = Language::create([
            'id'        => uuid(),
            'state'     => 1,
            'hide'      => 0,
            'language'  => 'German',
            'country'   => 'Germany',
            'plate'     => 'de',
            'locale'    => 'de',
        ]);

        $de->localized('de')->update([
            'language'      => 'Deutsch',
            'country'       => 'Deutschland',
        ]);

        $ru = Language::create([
            'id'        => uuid(),
            'state'     => 1,
            'hide'      => 0,
            'language'  => 'Russian',
            'country'   => 'Russia',
            'plate'     => 'ru',
            'locale'    => 'ru',
        ]);

        $ru->localized('de')->update([
            'language'      => 'Russisch',
            'country'       => 'Russland',
        ]);
    }

}
