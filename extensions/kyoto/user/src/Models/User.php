<?php

namespace Kyoto\User\Models;

use Illuminate\Support\Facades\Hash;
use Kyoto\Support\Database\User as Model;
use Kyoto\Support\Database\Traits\Castable;
use Kyoto\Support\Database\Traits\Datatable;
use Kyoto\Support\Database\Traits\Paginatable;
use Kyoto\Support\Database\Traits\State;

class User extends Model
{
    use Castable, Paginatable, Datatable, State;

    protected $table = 'users';

    protected $forceDelete = true;

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $relations = [
        'role', 'gate'
    ];

    protected $appends = [
        'gates', 'fooword', 'fooword_confirm'
    ];

    protected $attributes = [
        'id'       => null,
        'state'    => null,
        'name'     => null,
        'email'    => null,
        'password' => null,
    ];

    protected $casts = [
        'id'       => 'string',
        'state'    => 'integer',
        'name'     => 'string',
        'email'    => 'string',
        'password' => 'string',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function gate()
    {
        return $this->belongsTo(Gate::class, 'gate_id');
    }

    public function getGatesAttribute()
    {
        if ( empty($this->gate) ) {
            return [];
        }

        return $this->gate->getDescendantsAndSelf()
            ->pluck('id')->toArray();
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
        if ( ! empty($value) ) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function getFoowordAttribute()
    {
        return '';
    }

    public function setFoowordAttribute($value)
    {
        $this->setPasswordAttribute($value);
    }

    public function getFoowordConfirmAttribute()
    {
        return '';
    }

    public function setFoowordConfirmAttribute()
    {
        return;
    }

}
