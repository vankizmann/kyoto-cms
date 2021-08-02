<?php

use Illuminate\Database\Seeder;
use Kyoto\Menu\Facades\KyotoConnector;
use Kyoto\Menu\Models\Menu;
use Kyoto\Page\Models\Page;

class PageTableSeeder extends Seeder
{

    public function run()
    {
        $default = Menu::where('ident', 'menu-default')->firstOrFail();
        $footer = Menu::where('ident', 'menu-footer')->firstOrFail();

        $demo = Page::create([
            'id'        => uuid(),
            'state'     => 1,
            'title'     => 'Demopage',
            'content'   => 'This is a demo page.',
            'guard_id'  => null,
        ]);

        $demo->localized('de')->update([
            'title'     => 'Demoseite',
            'content'   => 'Dies ist eine Demoseite.',
        ]);

        $menu = new Menu([
            'parent' => $default, 'foreign_id' => $demo->id, 'type' => 'kyoto/page::page'
        ]);

        KyotoConnector::find('kyoto/page::page')
            ->transaction($menu, $demo)->save();

        $menu->makeFirstChildOf($default);

        $home = Page::create([
            'id'        => uuid(),
            'state'     => 1,
            'title'     => 'Homepage',
            'slug'      => '/',
            'content'   => 'This is a homepage.',
            'guard_id'  => null,
        ]);

        $home->localized('de')->update([
            'title'     => 'Startseite',
            'content'   => 'Dies ist eine Startseite.',
        ]);


        $menu = new Menu([
            'parent' => $footer, 'foreign_id' => $home->id, 'type' => 'kyoto/page::page'
        ]);

        KyotoConnector::find('kyoto/page::page')
            ->transaction($menu, $home)->save();

        $menu->makeFirstChildOf($default);

        $imprint = Page::create([
            'id'        => uuid(),
            'state'     => 1,
            'title'     => 'Imprint',
            'slug'      => 'imprint',
            'content'   => 'Hi im the imprint',
            'guard_id'  => null,
        ]);


        $menu = new Menu([
            'parent' => $footer, 'foreign_id' => $imprint->id, 'type' => 'kyoto/page::page'
        ]);

        KyotoConnector::find('kyoto/page::page')
            ->transaction($menu, $imprint)->save();

        for ($i = 0; $i < 100; $i++) {
            Page::create([
                'id'        => uuid(),
                'state'     => 1,
                'title'     => 'Test ' . $i,
                'slug'      => 'test-' . $i,
                'content'   => 'Hi im the test',
                'guard_id'  => null,
            ]);
        }

        //$menu->makeFirstChildOf($footer);

        // foreach ( Menu::where('type', 'kyoto/page::page')->get() as $menu ) {
        //     $menu->setAttribute('foreign_id', $page->id)
        //         ->setOption('page_id', $page->id)->save();
        // }

    }

}
