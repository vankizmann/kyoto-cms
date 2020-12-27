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

    public function enableGuard()
    {
        $this->guardState = true;

        return $this;
    }

    public function disableGuard()
    {
        $this->guardState = false;

        return $this;
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

    public function hasPolicyAction($action, $type = 'extension', $fallback = false)
    {
        if ( ! $this->getUser() ) {
            return $fallback;
        }

        if ( is_array($action) ) {
            $action = implode('@', $action);
        }

        return !! $this->getUser('role.policies')->whereIn('type', ['*', $type])
            ->whereIn('action', ['*', $action])->count();
    }

}
