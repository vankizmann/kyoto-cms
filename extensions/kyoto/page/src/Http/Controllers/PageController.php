<?php

namespace Kyoto\Page\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\Page\Models\Page;
use Kyoto\Page\Http\Requests\PageRequest;

class PageController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(Page::datatable());
    }

    public function show(Request $request)
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        $id = $request->query('id', null);

        $user = new Page;

        if ( ! empty($id) ) {
            $user = Page::findOrFail($id);
        }

        return response()->json([
            'data' => $user->toArray()
        ]);
    }

    public function store(PageRequest $request)
    {
        $user = Page::create($request->input());

        return response()->json([
            'data' => $user->toArray(), 'message' => trans('Page has been created!')
        ]);
    }

    public function update(PageRequest $request)
    {
        $id = $request->query('id');

        $user = Page::findOrFail($id);

        $user->fill($request->input())
            ->save();

        return response()->json([
            'data' => $user, 'message' => trans('Page has been updated!')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Page::findOrFail($id)->forceDelete();
        }

        return response()->json([
            'data' => [], 'message' => trans('Pages has been deleted!')
        ]);
    }

}
