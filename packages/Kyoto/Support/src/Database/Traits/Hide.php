<?php

namespace Kyoto\Support\Database\Traits;

trait Hide
{
    public function getHideColumn()
    {
        return 'hide';
    }

    public function scopeVisible($query)
    {
        /* @var \Illuminate\Database\Eloquent\Builder $query */
        return $query->where($this->getHideColumn(), 0);
    }

    public function scopeHidden($query)
    {
        /* @var \Illuminate\Database\Eloquent\Builder $query */
        return $query->where($this->getHideColumn(), 1);
    }

}
