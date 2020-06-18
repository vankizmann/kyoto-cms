<?php

namespace Kyoto\User;

use Illuminate\Support\Facades\Auth;

class UserManager
{
    public $activeUser = null;

    protected $guardState = true;

    public function isGuarded()
    {
        return $this->guardState;
    }

    public function isNotGuarded()
    {
        return ! $this->guardState;
    }

    public function disableGuarded()
    {
        $this->guardState = false;
    }

    public function enableGuarded()
    {
        $this->guardState = true;
    }

    public function unguarded($callback)
    {
        $guardState = $this->guardState;
        $this->guardState = false;
        $result = app()->call($callback);
        $this->guardState = $guardState;

        return $result;
    }

    public function guarded($callback)
    {
        $guardState = $this->guardState;
        $this->guardState = true;
        $result = app()->call($callback);
        $this->guardState = $guardState;

        return $result;
    }

    public function getUser($key = null, $fallback = null)
    {
        $user = $this->activeUser ?: Auth::user();

        if ( $key === null ) {
            return $user;
        }

        return data_get($user, $key, $fallback);
    }

    public function setUser($user)
    {
        $this->activeUser = $user;
    }

    public function getGateDepth($fallback = 100000)
    {
        return $this->getUser('gate.depth', $fallback);
    }

    public function hasPolicyAction($class, $action, $fallback = false)
    {
        if ( ! $this->getUser() ) {
            return $this->getUser()->hasPolicyAction($class, $action);
        }

        return $fallback;
    }

}
