<?php

use Illuminate\Database\Seeder;
use Kyoto\Menu\Facades\Connector;
use Kyoto\Menu\Models\Menu;
use Kyoto\Page\Models\Page;

class PageTableSeeder extends Seeder
{

    public function run()
    {
        $root = Menu::where('ident', 'web-frontend')->firstOrFail();

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
            'parent' => $root, 'foreign_id' => $demo->id, 'type' => 'kyoto/page::page'
        ]);

        Connector::find('kyoto/page::page')
            ->transaction($menu, $demo)->save();

        $menu->makeFirstChildOf($root);

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
            'parent' => $root, 'foreign_id' => $home->id, 'type' => 'kyoto/page::page'
        ]);

        Connector::find('kyoto/page::page')
            ->transaction($menu, $home)->save();

        $menu->makeFirstChildOf($root);

        // foreach ( Menu::where('type', 'kyoto/page::page')->get() as $menu ) {
        //     $menu->setAttribute('foreign_id', $page->id)
        //         ->setOption('page_id', $page->id)->save();
        // }

    }

}
