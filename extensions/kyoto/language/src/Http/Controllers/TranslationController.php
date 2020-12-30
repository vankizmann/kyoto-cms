<?php

namespace Kyoto\Language\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\User\Facades\KyotoUser;
use Kyoto\Language\Models\Translation;
use Kyoto\Language\Http\Requests\TranslationRequest;

class TranslationController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        if ( ! KyotoUser::hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(Translation::datatable());
    }

    public function show(Request $request)
    {
        $id = $request->query('id', null);

        $language = new Translation;

        if ( ! empty($id) ) {
            $language = Translation::findOrFail($id);
        }

        return response()->json([
            'data' => $language->toArray()
        ]);
    }

    public function store(TranslationRequest $request)
    {
        $language = Translation::create($request->input());

        // Save entity
        $language->save();

        return response()->json([
            'data' => $language->toArray(), 'message' => trans('Translation has been created')
        ]);
    }

    public function update(TranslationRequest $request)
    {
        $id = $request->query('id');

        $language = Translation::findOrFail($id);

        $language->fill($request->input())
            ->save();

        return response()->json([
            'data' => $language, 'message' => trans('Translation has been updated')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Translation::findOrFail($id)->forceDelete();
        }

        return response()->json([
            'data' => [], 'message' => trans('Translations have been deleted')
        ]);
    }

}
