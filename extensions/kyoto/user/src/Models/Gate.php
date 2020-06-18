<?php

namespace Kyoto\User\Models;

use Baum\NestedSet\Node;
use Kyoto\Support\Database\Model;

class Gate extends Model
{
    use Node;

    protected $table = 'gates';

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'lft', 'rgt', 'parent_id'
    ];

    protected $relationships = [
        'parent', 'childs'
    ];

    protected $attributes = [
        'id'          => null,
        'title'       => null,
        'description' => null,
    ];

    protected $casts = [
        'id'          => 'uuid',
        'title'       => 'string',
        'description' => 'string',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'gate_id');
    }

}
