<?php

namespace Kyoto\User\Models;

use Baum\NestedSet\Node;
use Kyoto\Support\Database\Model;

class Role extends Model
{
    use Node;

    protected $table = 'roles';

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
        return $this->belongsToMany(User::class, 'user_to_role', 'role_id', 'user_id');
    }

    public function policies()
    {
        return $this->belongsToMany(Policy::class, 'role_to_policy', 'role_id', 'policy_id');
    }

}
