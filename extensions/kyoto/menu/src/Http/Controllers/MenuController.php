<?php

namespace Kyoto\Menu\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\Application\Facades\Kyoto;
use Kyoto\User\Facades\KyotoUser;
use Kyoto\Menu\Facades\KyotoConnector;
use Kyoto\Menu\Models\Menu;
use Kyoto\Menu\Http\Requests\MenuRequest;

class MenuController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        if ( ! KyotoUser::hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        $query = new Menu;

        if ( Kyoto::isSystemDisabled() ) {
            $query = $query->where('system', 0);
        }

        return response()->json($query->datatree());
    }

    public function show(Request $request)
    {
        $id = $request->query('id', null);

        $menu = new Menu;

        if ( ! empty($id) ) {
            $menu = Menu::findOrNew($id);
        }

        return response()->json(['data' => $menu]);
    }

    public function store(MenuRequest $request)
    {
        $menu = Menu::create($request->input());

        // Save entity
        $menu->save();

        return response()->json([
            'data' => $menu, 'message' => trans('Menu has been created')
        ]);
    }

    public function update(MenuRequest $request)
    {
        $id = $request->query('id');

        $menu = Menu::findOrFail($id);

        $menu->fill($request->input())
            ->save();

        return response()->json([
            'data' => $menu->refresh(), 'message' => trans('Menu has been updated')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Menu::findOrFail($id)->forceDelete();
        }

        return response()->json([
            'data' => [], 'message' => trans('Menus have been deleted')
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
            'data' => [], 'message' => trans('Menus have been moved')
        ]);
    }

    public function transaction(Request $request)
    {
        $data = $request->only(['source', 'target', 'strategy']);

        Kyoto::localized(null, function () use ($data) {


        foreach ( (array) $data['source'] as $index => $source ) {

            $menuNode = (new Menu)->fill([
                'type' => $source['transaction']
            ]);

            $data['source'][$index] = KyotoConnector::find($menuNode->type)
                ->transaction($menuNode, $source);

            $data['source'][$index]->save();
        }

        if ( $data['strategy'] === 'root' ) {

            foreach ( (array) $data['source'] as $sourceNode ) {
                $sourceNode->makeRoot();
            }

        }

        if ( $data['strategy'] === 'inner' ) {

            $targetNode = Menu::findOrFail($data['target']);

            foreach ( (array) $data['source'] as $sourceNode ) {
                $sourceNode->makeChildOf($targetNode);
            }

        }

        if ( $data['strategy'] === 'before' ) {

            $targetNode = Menu::findOrFail($data['target']);

            foreach ( (array) $data['source'] as $sourceNode ) {
                $sourceNode->moveToLeftOf($targetNode);
            }

        }

        if ( $data['strategy'] === 'after' ) {

            $targetNode = Menu::findOrFail($data['target']);

            foreach ( (array) $data['source'] as $sourceNode ) {
                $sourceNode->moveToRightOf($targetNode);
            }

        }

        });

        return response()->json([
            'data' => [], 'message' => trans('Menus have been inserted')
        ]);
    }

}
