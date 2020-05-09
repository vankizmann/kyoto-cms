<?php

namespace Kyoto\Support\Collection;

use MJS\TopSort\Implementations\StringSort;

class CollectionMacros
{
    /**
     * Merge inside subkeys.
     *
     * @return \Closure
     */
    public function setMerge()
    {
        return function($key, $collection)
        {
            $value = $this->wrap(
                $this->get($key, new self)
            );

            $this->put($key, $value->merge($collection));
        };
    }

    /**
     * Merge the diffrence.
     *
     * @return \Closure
     */
    public function mergeDiff()
    {
        return function($key, $collection)
        {
            $diffrence = $this->wrap($collection)->diff(
                $this->get($key, new self)
            );

            $this->setMerge($key, $diffrence);

            return $diffrence;
        };
    }

    /**
     * Find items by key.
     *
     * @return \Closure
     */
    public function findByKeys()
    {
        return function($keys)
        {
            return $this->filter(function ($value, $key) use ($keys) {
                return in_array('*', (array) $keys) || in_array($key, (array) $keys);
            });
        };
    }

    /**
     * Sort by dependency key.
     *
     * @return \Closure
     */
    public function sortByDeps()
    {
        return function ($depsKey = 'deps')
        {
            $sorter = new StringSort();

            $this->each(function ($item, $key) use ($sorter, $depsKey) {
                $sorter->add($key, $this->keys()->intersect($item[$depsKey])->toArray());
            });

            $sorted = $sorter->sort();

            $result = $this->sortBy(function ($item, $key) use ($sorted) {
                return collect($sorted)->search($key);
            });

            return $result;
        };
    }

}
