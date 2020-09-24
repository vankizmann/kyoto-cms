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

    public function show(Request $request)
    {
        $id = $request->query('id', null);

        $language = new Language;

        if ( ! empty($id) ) {
            $language = Language::findOrFail($id);
        }

        return response()->json([
            'data' => $language->toArray()
        ]);
    }

    public function store(LanguageRequest $request)
    {
        $language = Language::create($request->input());

        // Save entity
        $language->save();

        // Update languages
        app('kyoto.language')->update();

        return response()->json([
            'data' => $language->toArray(), 'message' => trans('Language has been created!')
        ]);
    }

    public function update(LanguageRequest $request)
    {
        $id = $request->query('id');

        $language = Language::findOrFail($id);

        $language->fill($request->input())
            ->save();

        // Update languages
        app('kyoto.language')->update();

        return response()->json([
            'data' => $language, 'message' => trans('Language has been updated!')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Language::findOrFail($id)->forceDelete();
        }

        // Update languages
        app('kyoto.language')->update();

        return response()->json([
            'data' => [], 'message' => trans('Languages has been deleted!')
        ]);
    }

}
