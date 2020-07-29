<?php

namespace Kyoto\Page\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\Page\Models\Page;

class PageController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(Page::datatable());
    }

    public function create()
    {
        $menu = new Page;

        return response()->json($menu);
    }

    public function store(Request $request)
    {
        $menu = (new Page)->fill($request->input())->save();

        return response()->json($menu);
    }

    public function show(Request $request)
    {
        $id = $request->query('id');

        $menu = Page::findOrFail($id)
            ->toArray();

        return response()->json($menu);
    }

    public function update(Request $request)
    {
        $id = $request->query('id');

        $menu = Page::withDepthGuard()
            ->findOrFail($id);

        $menu->fill($request->input())->save();

        return response()->json([
            'data' => $menu, 'message' => trans('Page has been updated!')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Page::findOrFail($id)->update(['state' => -1]);
        }

        return response()->json([
            'data' => [], 'message' => trans('Pages has been deleted!')
        ]);
    }

}
