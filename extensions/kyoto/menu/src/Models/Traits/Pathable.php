<?php

namespace Kyoto\Menu\Models\Traits;

use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Kyoto\Application\Facades\Kyoto;
use Kyoto\Menu\Models\Menu;

trait Pathable
{

    public static function bootPathable()
    {
        if ( method_exists(static::class, 'saved') ) {
            static::saved(function ($model) {
                if ( ! $model->isMenuEntity() || $model->isBaseLocale() ) {
                    $model->refreshRouteAndPath();
                }
            });
        }

        if ( method_exists(static::class, 'moved') ) {
            static::moved(function ($model) {
                if ( Kyoto::isReady() ) {
                    $model->refreshMovedRouteAndPath();
                }
            });
        }

    }

    public function getParentAttribute()
    {
        if ( ! $this->isMenuEntity() ) {
            return $this->getForeign()->getParentAttribute();
        }

        $parentNode = $this->parent()->first();

        if ( $parentNode ) {
            return $parentNode->localized($this->forceLocale);
        }

        return $parentNode;
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = trim($value, '/');
    }

    public function isMenuEntity()
    {
        return is_a($this, Menu::class);
    }

    public function getForeign()
    {
        if ( $this->isMenuEntity() ) {
            return Menu::findOrFail($this->id)->localized('en');
        }

        return Menu::findOrFail($this->foreign_id)
            ->localized($this->locale);
    }

    public function getLocalesToPatch()
    {
        if ( ! $this->isMenuEntity() ) {
            return [$this->locale];
        }

        return array_filter(Kyoto::getLocales(), function ($locale) {
            return ! $this->hasTranslation($locale);
        });
    }

    public function patchRouteAndPath()
    {
        $parent = $this->getForeign()->getParentAttribute();

        if ( empty($parent) ) {
            $this->attributes['path'] = $this->attributes['slug'];
        }

        $this->attributes['route'] = $this->slug ?: '/';

        if ( ! empty($parent) && ! empty($parent->parent_id) ) {
            $this->attributes['route'] = str_join('/', $parent->route, $this->slug);
        }

        if ( ! empty($this->route) ) {
            $this->attributes['route'] = '/' . trim($this->attributes['route'], '/');
        }

        if ( ! empty($parent) ) {
            $this->attributes['path'] = str_join('/', $parent->path, $this->slug);
        }

        return $this;
    }

    public function refreshRouteAndPath()
    {
        if ( ! $this->slug && ! $this->isMenuEntity() ) {
            return;
        }

        $this->patchRouteAndPath();

        Log::debug("Patched path {$this->path}");

        $data = [
            'path' => $this->path, 'route' => $this->route
        ];

        if ( $this->getForeign()->path !== $this->path ) {
            $this->updateChildsPathAndRoute();
        }

        DB::table($this->getTable())->where('id', $this->id)
            ->update($data);
    }

    public function updateChildsPathAndRoute()
    {
        $foreign = $this->getForeign();

        if ( empty($foreign->path) ) {
            return;
        }

        Log::debug("Path paths from {$foreign->path} to {$this->path}");

        $data = [
            'path' => DB::raw("REPLACE(`path`, '{$foreign->path}', '{$this->path}')"),
            'route' => DB::raw("REPLACE(`route`, '{$foreign->route}', '{$this->route}')"),
        ];

        $childs = $foreign->getDescendants()
            ->pluck('id')->toArray();

        if ( $this->isMenuEntity() ) {
            DB::table('menus')->whereIn('id', $childs)->update($data);
        }

        $locales = $this->getLocalesToPatch();

        DB::table('menu_locales')->whereIn('foreign_id', $childs)
            ->whereIn('locale', $locales)->update($data);
    }

    public function refreshMovedRouteAndPath()
    {
        Menu::findOrFail($this->id)->localized('en')->save();
    }

}
