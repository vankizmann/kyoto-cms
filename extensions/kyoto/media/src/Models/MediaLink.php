<?php

namespace Kyoto\Media\Models;

class MediaLink extends \Kyoto\Support\Database\Model
{
    protected $table = 'media_links';

    protected $guarded = [
        'id'
    ];

    protected $attributes = [
        'id'            => null,
        'sequence'      => null,
        'foreign_id'    => null,
        'media_id'      => null,
    ];

    protected $casts = [
        'id'            => 'uuid',
        'sequence'      => 'integer',
        'foreign_id'    => 'uuid',
        'media_id'      => 'uuid',
    ];

    protected $with = [
        'media'
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

}
