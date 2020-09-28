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

    public function move(Request $request)
    {
        $data = $request->only(['source', 'target', 'strategy']);

        if ( $data['strategy'] === 'root' ) {

            foreach ( (array) $data['source'] as $id ) {
                Menu::findOrFail($id)->makeRoot();
            }

        }


        if ( $data['strategy'] === 'inner' ) {

            $targetNode = Menu::findOrFail($data['target']);

            foreach ( (array) $data['source'] as $id ) {
                Menu::findOrFail($id)->makeChildOf($targetNode);
            }

        }

        if ( $data['strategy'] === 'before' ) {

            $targetNode = Menu::findOrFail($data['target']);

            foreach ( (array) $data['source'] as $id ) {
                Menu::findOrFail($id)->moveToLeftOf($targetNode);
            }

        }

        if ( $data['strategy'] === 'after' ) {

            $targetNode = Menu::findOrFail($data['target']);

            foreach ( (array) $data['source'] as $id ) {
                Menu::findOrFail($id)->moveToRightOf($targetNode);
            }

        }

        return response()->json([
            'data' => [], 'message' => trans('Menus has been moved!')
        ]);
    }

}
