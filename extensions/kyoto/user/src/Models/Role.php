<?php

namespace Kyoto\User\Models;

use Kyoto\Support\Database\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $guarded = [
        'id',
    ];

    protected $attributes = [
        'id'          => null,
        'title'       => null,
        'description' => null,
        'access'      => null,
        'guard'       => null,
    ];

    protected $casts = [
        'id'          => 'uuid',
        'title'       => 'string',
        'description' => 'string',
        'access'      => 'string',
        'guard'       => 'integer',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_to_role', 'role_id', 'user_id');
    }

//    public function policies()
//    {
//        return $this->belongsToMany(Policy::class, 'role_to_policy', 'role_id', 'policy_id');
//    }

}
