<?php

namespace Kyoto\Menu\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\Application\Facades\Kyoto;
use Kyoto\Menu\Facades\Connector;
use Kyoto\Menu\Models\Menu;
use Kyoto\Menu\Http\Requests\MenuRequest;

class MenuController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        $query = new Menu;

        if ( ! isset($_COOKIE['kyoto_sysmode']) || $_COOKIE['kyoto_sysmode'] !== '1' ) {
            $query = $query->where('system', 0);
        }

        return response()->json($query->datatree());
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
        $data = $request->only(['sources', 'target', 'strategy']);

        if ( $data['strategy'] === 'root' ) {

            foreach ( (array) $data['sources'] as $id ) {
                Menu::findOrFail($id)->makeRoot();
            }

        }


        if ( $data['strategy'] === 'inner' ) {

            $targetNode = Menu::findOrFail($data['target']);

            foreach ( (array) $data['sources'] as $id ) {
                Menu::findOrFail($id)->makeChildOf($targetNode);
            }

        }

        if ( $data['strategy'] === 'before' ) {

            $targetNode = Menu::findOrFail($data['target']);

            foreach ( (array) $data['sources'] as $id ) {
                Menu::findOrFail($id)->moveToLeftOf($targetNode);
            }

        }

        if ( $data['strategy'] === 'after' ) {

            $targetNode = Menu::findOrFail($data['target']);

            foreach ( (array) $data['sources'] as $id ) {
                Menu::findOrFail($id)->moveToRightOf($targetNode);
            }

        }

        return response()->json([
            'data' => [], 'message' => trans('Menus has been moved!')
        ]);
    }

    public function transaction(Request $request)
    {
        $data = $request->only(['sources', 'target', 'strategy']);

        foreach ( (array) $data['sources'] as $index => $source ) {

            $menuNode = (new Menu)->fill([
                'id' => uuid(), 'state' => 1, 'hide' => 0, 'matrix' => 1, 'guard' => 0, 'type' => $source['transaction']
            ]);

            $data['sources'][$index] = Connector::find($menuNode->type)
                ->transaction($menuNode, $source);

            $data['sources'][$index]->save();
        }

        if ( $data['strategy'] === 'root' ) {

            foreach ( (array) $data['sources'] as $sourceNode ) {
                $sourceNode->makeRoot();
            }

        }


        if ( $data['strategy'] === 'inner' ) {

            $targetNode = Menu::findOrFail($data['target']);

            foreach ( (array) $data['sources'] as $sourceNode ) {
                $sourceNode->makeChildOf($targetNode);
            }

        }

        if ( $data['strategy'] === 'before' ) {

            $targetNode = Menu::findOrFail($data['target']);

            foreach ( (array) $data['sources'] as $sourceNode ) {
                $sourceNode->moveToLeftOf($targetNode);
            }

        }

        if ( $data['strategy'] === 'after' ) {

            $targetNode = Menu::findOrFail($data['target']);

            foreach ( (array) $data['sources'] as $sourceNode ) {
                $sourceNode->moveToRightOf($targetNode);
            }

        }

        return response()->json([
            'data' => [], 'message' => trans('Menus has been inserted!')
        ]);
        //dd($data);
    }

}
