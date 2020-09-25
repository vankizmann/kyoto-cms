<?php

namespace Kyoto\Menu\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\Menu\Models\Menu;
use Kyoto\Menu\Http\Requests\MenuRequest;

class MenuController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(Menu::datatree());
    }

    public function show(Request $request)
    {
        $id = $request->query('id', null);

        $menu = new Menu;

        if ( ! empty($id) ) {
            $menu = Menu::findOrFail($id);
        }

        return response()->json([
            'data' => $menu
        ]);
    }

    public function store(MenuRequest $request)
    {
        $menu = Menu::create($request->input());

        // Save entity
        $menu->save();

        return response()->json([
            'data' => $menu, 'message' => trans('Menu has been created!')
        ]);
    }

    public function update(MenuRequest $request)
    {
        $id = $request->query('id');

        $menu = Menu::findOrFail($id);

        $menu->fill($request->input())
            ->save();

        return response()->json([
            'data' => $menu->refresh(), 'message' => trans('Menu has been updated!')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Menu::findOrFail($id)->forceDelete();
        }

        return response()->json([
            'data' => [], 'message' => trans('Menus has been deleted!')
        ]);
    }

}
