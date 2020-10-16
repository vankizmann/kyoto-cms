<?php

use Illuminate\Database\Seeder;
use Kyoto\Menu\Models\Menu;
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

        Menu::where('type', 'kyoto/page::page')->update([
            'foreign_id' => $page->id
        ]);
    }

}
