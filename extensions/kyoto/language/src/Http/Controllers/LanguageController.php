<?php

namespace Kyoto\Language\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\Language\Models\Language;
use Kyoto\Language\Http\Requests\LanguageRequest;

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
        $language = new Language;

        return response()->json($language);
    }

    public function store(Request $request)
    {
        $language = (new Language)->fill($request->input())->save();

        return response()->json($language);
    }

    public function show(Request $request)
    {
        $id = $request->query('id');

        $language = Language::findOrFail($id)
            ->toArray();

        return response()->json([
            'data' => $language
        ]);
    }

    public function update(LanguageRequest $request)
    {
        $id = $request->query('id');

        $language = Language::findOrFail($id);

        $language->fill($request->input())
            ->save();

        return response()->json([
            'data' => $language, 'message' => trans('Language has been updated!')
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
