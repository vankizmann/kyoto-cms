<?php

namespace Kyoto\User\Models;

use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Support\Facades\Hash;
use Kyoto\Support\Database\Traits\Castable;
use Kyoto\Support\Database\Traits\Datatable;
use Kyoto\Support\Database\Traits\Paginatable;
use Kyoto\Support\Database\Traits\State;

class User extends Model
{
    use Castable, Paginatable, Datatable, State;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $table = 'users';

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'role_ids'
    ];

    protected $attributes = [
        'id'       => null,
        'state'    => null,
        'name'     => null,
        'email'    => null,
        'password' => null,
        'guard'    => null,
    ];

    protected $casts = [
        'id'       => 'uuid',
        'state'    => 'integer',
        'name'     => 'string',
        'email'    => 'string',
        'password' => 'string',
        'guard'    => 'integer',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_to_role', 'user_id', 'role_id');
    }

//    public function getPoliciesAttribute()
//    {
//        return $this->roles()->get()->pluck('policies')->flatten(1);
//    }
//
//    public function getPolicyModulesAttribute()
//    {
//        return $this->policies->where('module', '!=', '')->pluck('module')->flatten(1);
//    }
//
//    public function getPolicyDepth($class)
//    {
//        return $this->policies->where('class', $class)
//            ->where('method', '')->pluck('depth')->min() ?: 0;
//    }
//
//    public function hasPolicyAction($class, $method)
//    {
//        return $this->policies->where('class', $class)
//            ->whereIn('method', ['*', $method])->isNotEmpty() ?: false;
//    }
//
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getRoleIdsAttribute()
    {
        return $this->roles()->get()->pluck('id')->flatten(1);
    }
//
//    public function setRoleIdsAttribute($value)
//    {
//        $this->saved(function ($model) use ($value) {
//            $model->roles()->sync($value);
//        });
//    }

    public function setPasswordConfirmAttribute()
    {
        return;
    }

}
