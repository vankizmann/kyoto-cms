<?php

namespace Kyoto\Media\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\Media\Models\Media;

class MediaController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(Media::datatable());
    }

    public function create()
    {
        $menu = new Media;

        return response()->json($menu);
    }

    public function store(Request $request)
    {
        $menu = (new Media)->fill($request->input())->save();

        return response()->json($menu);
    }

    public function show(Request $request)
    {
        $id = $request->query('id');

        $menu = Media::findOrFail($id)
            ->toArray();

        return response()->json($menu);
    }

    public function update(Request $request)
    {
        $id = $request->query('id');

        $menu = Media::withDepthGuard()
            ->findOrFail($id);

        $menu->fill($request->input())->save();

        return response()->json([
            'data' => $menu, 'message' => trans('Media has been updated!')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Media::findOrFail($id)->update(['state' => -1]);
        }

        return response()->json([
            'data' => [], 'message' => trans('Medias has been deleted!')
        ]);
    }

}
