<?php

namespace Kyoto\Menu\Models;

use Illuminate\Support\Facades\DB;
use Kyoto\Support\Database\Model;

class MenuLocale extends Model
{
    protected $table = 'menu_locales';

    protected $fillable = [
        'id', 'foreign_id', 'locale', 'title', 'slug', 'route', 'path'
    ];

    protected $attributes = [
        'id'            => null,
        'locale'        => null,
        'title'         => null,
        'slug'          => null,
        'route'         => null,
        'path'          => null,
    ];

    protected $casts = [
        'id'            => 'string',
        'locale'        => 'string',
        'title'         => 'string',
        'slug'          => 'string',
        'route'         => 'string',
        'path'          => 'string',
    ];

    protected static function boot()
    {
        static::saved(function ($model) {

            $foreign = Menu::findOrFail($model->foreign_id)
                ->localized($model->locale);

            if ( $parentNode = $foreign->parent && $model->slug ) {

                $model->attributes['route'] = $model->slug;

                if ( ! empty($parentNode->parent_id) ) {
                    $model->attributes['route'] = str_join('/', $parentNode->route, $model->slug);
                }

                if ( $model->attributes['route'] ) {
                    $model->attributes['route'] = '/' . trim($model->attributes['route'], '/');
                }

                $model->attributes['path'] = str_join('/', $parentNode->path, $model->slug);

                $data = [
                    'path' => $model->attributes['path'], 'route' => $model->attributes['route']
                ];

                DB::table('menu_locales')->where('id', $model->id)->update($data);
            }

            if ( app('kyoto')->isReady() ) {
                app('kyoto.menu')->updateMenu($model->locale);
            }

        });

        parent::boot();
    }

    public function getRouteAttribute2()
    {
        return '/' . trim($this->attributes['route'], '/');
    }

    public function setSlugAttribute($value)
    {
        if ( empty($this->parent_id) ) {
            $this->attributes['path'] = trim($value, '/');
        }

        $this->attributes['slug'] = trim($value, '/');;
    }

}
