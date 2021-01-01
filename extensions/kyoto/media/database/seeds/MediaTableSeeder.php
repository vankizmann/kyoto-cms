<?php

use Illuminate\Database\Seeder;
use Kyoto\Media\Models\Media;

class MediaTableSeeder extends Seeder
{

    public function run()
    {
        $value = Media::create([
            'id'        => uuid(),
            'title'     => 'Images',
            'type'      => 'system/folder',
        ]);

        $value->localized('de')->update([
            'title'      => 'Bilder',
        ]);

        $value = Media::create([
            'id'        => uuid(),
            'title'     => 'Movies',
            'type'      => 'system/folder',
        ]);

        $value->localized('de')->update([
            'title'      => 'Filme',
        ]);

        $value = Media::create([
            'id'        => uuid(),
            'title'     => 'Documents',
            'type'      => 'system/folder',
        ]);

        $value->localized('de')->update([
            'title'      => 'Dokumente',
        ]);
    }

}
