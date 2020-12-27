<?php

namespace Kyoto\Package\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\Application\Facades\Kyoto;
use Kyoto\Menu\Facades\KyotoConnector;
use Kyoto\User\Facades\KyotoUser;
use Kyoto\Package\Models\Package;

class PackageController extends \App\Http\Controllers\Controller
{

    public function index()
    {
        if ( ! KyotoUser::hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(Package::datatable());
    }

    public function show(Request $request)
    {
        $id = $request->query('id', null);

        $menu = new Package;

        if ( ! empty($id) ) {
            $menu = Package::findOrFail($id);
        }

        return response()->json([
            'data' => $menu
        ]);
    }

    public function store(Request $request)
    {
        $menu = Package::create($request->input());

        // Save entity
        $menu->save();

        return response()->json([
            'data' => $menu, 'message' => trans('Package has been created!')
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->query('id');

        $menu = Package::findOrFail($id);

        $menu->fill($request->input())
            ->save();

        return response()->json([
            'data' => $menu->refresh(), 'message' => trans('Package has been updated!')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Package::findOrFail($id)->forceDelete();
        }

        return response()->json([
            'data' => [], 'message' => trans('Packages has been deleted!')
        ]);
    }

    public function move(Request $request)
    {
        $data = $request->only(['source', 'target', 'strategy']);

        if ( $data['strategy'] === 'root' ) {

            foreach ( (array) $data['source'] as $id ) {
                Package::findOrFail($id)->makeRoot();
            }

        }


        if ( $data['strategy'] === 'inner' ) {

            $targetNode = Package::findOrFail($data['target']);

            foreach ( (array) $data['source'] as $id ) {
                Package::findOrFail($id)->makeChildOf($targetNode);
            }

        }

        if ( $data['strategy'] === 'before' ) {

            $targetNode = Package::findOrFail($data['target']);

            foreach ( (array) $data['source'] as $id ) {
                Package::findOrFail($id)->moveToLeftOf($targetNode);
            }

        }

        if ( $data['strategy'] === 'after' ) {

            $targetNode = Package::findOrFail($data['target']);

            foreach ( (array) $data['source'] as $id ) {
                Package::findOrFail($id)->moveToRightOf($targetNode);
            }

        }

        return response()->json([
            'data' => [], 'message' => trans('Packages has been moved!')
        ]);
    }

    public function connector()
    {
        $data = [];

        foreach ( KyotoConnector::keys() as $key ) {
            $data[] = ['label' => Kyoto::localize($key), 'value' => $key];
        }

        return response()->json($data);
    }

}
