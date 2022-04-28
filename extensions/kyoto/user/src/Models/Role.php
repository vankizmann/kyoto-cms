<?php

namespace Kyoto\User\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Kyoto\Support\Database\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $guarded = [
        'id',
    ];

    protected $appends = [
        'policies'
    ];

    protected $fillable = [
        'policies'
    ];

    protected $attributes = [
        'id'          => null,
        'title'       => null,
        'description' => null,
    ];

    protected $casts = [
        'id'          => 'string',
        'title'       => 'string',
        'description' => 'string',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    public function getUsersAttribute()
    {
        return $this->users()->get();
    }

    public function setUsersAttribute($value)
    {
        self::saved(function ($model) use ($value) {
            $model->users()->sync(collect($value)->pluck('id'));
        });
    }

    public function policies()
    {
        return $this->belongsToMany(Policy::class, 'role_to_policy', 'role_id', 'policy_id');
    }

    public function getPoliciesAttribute()
    {
        return $this->policies()->get();
    }

    public function setPoliciesAttribute($value)
    {
        self::saved(function ($model) use ($value) {
            $model->policies()->sync(collect($value)->pluck('id'));
        });
    }

}
