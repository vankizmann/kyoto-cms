<?php

namespace Kyoto\Language\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\Language\Models\Language;

class LanguageController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(Language::datatable());
    }

    public function create()
    {
        $menu = new Language;

        return response()->json($menu);
    }

    public function store(Request $request)
    {
        $menu = (new Language)->fill($request->input())->save();

        return response()->json($menu);
    }

    public function show(Request $request)
    {
        $id = $request->query('id');

        $menu = Language::findOrFail($id)
            ->toArray();

        return response()->json($menu);
    }

    public function update(Request $request)
    {
        $id = $request->query('id');

        $menu = Language::withDepthGuard()
            ->findOrFail($id);

        $menu->fill($request->input())->save();

        return response()->json([
            'data' => $menu, 'message' => trans('Language has been updated!')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Language::findOrFail($id)->update(['state' => -1]);
        }

        return response()->json([
            'data' => [], 'message' => trans('Languages has been deleted!')
        ]);
    }

}
