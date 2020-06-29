<?php

namespace Kyoto\Menu\Http\Controllers;

//use App\Database\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kyoto\Menu\Models\Menu;

//use Liro\Web\Menu\Http\Requests\MenuUpdateRequest;

class MenuController extends Controller
{
    public function index()
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(Menu::datatree());
    }

    public function toArray($item)
    {
        return array_merge($item->toArray(), [
            'children' => $item->children->map([$this, 'toArray'])
        ]);
    }

    public function getTreeRoute()
    {
        $query = Menu::with(['children'])->withDepthGuard()->notArchived();

        if ( ! empty(request()->input('search')) ) {

            $query = $query->where('title', 'LIKE',
                '%' . request()->input('search') . '%');

            foreach ( $query->get() as $menu ) {
                $query->orWhereIn('id', $menu->getAncestors()->pluck('id'));
            }

        }

        clock()->startEvent('MenuController.buildMenuTree', 'Build Menu Tree');

        $menus = $query->getTree();

        clock()->endEvent('MenuController.buildMenuTree');

        return response()->json($menus);
    }

    public function getIndexRoute()
    {
        $menus = Menu::withDepthGuard()
            ->datatable();

        return response()->json($menus);
    }

    public function getCreateRoute()
    {
        $menu = new Menu;

        return response()->json($menu);
    }

    public function postStoreRoute()
    {
        $menu = new Menu;

        return response()->json($menu);
    }

    public function show(Request $request)
    {
        $id = $request->query('id');

        $menu = Menu::findOrFail($id)
            ->toArray();

        return response()->json($menu);
    }

    public function postUpdateRoute(MenuUpdateRequest $request, $id)
    {
        $menu = Menu::withDepthGuard()
            ->findOrFail($id);

        $menu->fill($request->input())->save();

        return response()->json([
            'data' => $menu, 'message' => trans('Menu has been updated!')
        ]);
    }

    public function postActivateRoute()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Menu::findOrFail($id)->update(['state' => 1]);
        }

        return response()->json([
            'data' => [], 'message' => trans('Menus has been activated!')
        ]);
    }

    public function postDeactivateRoute()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Menu::findOrFail($id)->update(['state' => 0]);
        }

        return response()->json([
            'data' => [], 'message' => trans('Menus has been deactivated!')
        ]);
    }

    public function postArchiveRoute()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Menu::findOrFail($id)->update(['state' => 2]);
        }

        return response()->json([
            'data' => [], 'message' => trans('Menus has been archived!')
        ]);
    }

    public function postDeleteRoute()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Menu::findOrFail($id)->update(['state' => -1]);
        }

        return response()->json([
            'data' => [], 'message' => trans('Menus has been deleted!')
        ]);
    }

}
