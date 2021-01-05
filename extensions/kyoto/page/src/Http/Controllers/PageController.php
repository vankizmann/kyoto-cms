<?php

namespace Kyoto\Page\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\User\Facades\KyotoUser;
use Kyoto\Page\Models\Page;
use Kyoto\Page\Http\Requests\PageRequest;

class PageController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        if ( ! KyotoUser::hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(Page::datatable());
    }

    public function show(Request $request)
    {
        if ( ! KyotoUser::hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        $id = $request->query('id', null);

        $page = new Page;

        if ( ! empty($id) ) {
            $page = Page::findOrFail($id);
        }

        return response()->json([
            'data' => $page->toArray()
        ]);
    }

    public function store(PageRequest $request)
    {
        $page = Page::create($request->input());

        return response()->json([
            'data' => $page->toArray(), 'message' => trans('Page has been created')
        ]);
    }

    public function update(PageRequest $request)
    {
        $id = $request->query('id');

        $page = Page::findOrFail($id);

        $page->fill($request->input())
            ->save();

        return response()->json([
            'data' => $page, 'message' => trans('Page has been updated')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Page::findOrFail($id)->forceDelete();
        }

        return response()->json([
            'data' => [], 'message' => trans('Pages have been deleted')
        ]);
    }

}
