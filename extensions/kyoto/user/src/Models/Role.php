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
    ];

    protected $casts = [
        'id'          => 'uuid',
        'title'       => 'string',
        'description' => 'string',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    public function policies()
    {
        return $this->belongsToMany(Policy::class, 'role_to_policy', 'role_id', 'policy_id');
    }

}
