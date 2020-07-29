<?php

use Illuminate\Database\Seeder;
use Kyoto\Page\Models\Page;

class PageTableSeeder extends Seeder
{

    public function run()
    {
        $page = Page::create([
            'id'        => uuid(),
            'title'     => 'Testpage',
            'content'   => 'This is a demo page.',
            'guard_id'  => null,
        ]);

        $page->localized('de')->update([
            'title'     => 'Testseite',
            'content'   => 'Dies ist eine Demoseite.',
        ]);
    }

}
