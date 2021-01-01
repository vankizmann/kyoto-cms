<?php

namespace Kyoto\Media\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\Media\Models\Media;
use Kyoto\User\Facades\KyotoUser;
use Kyoto\Media\Http\Requests\MediaRequest;

class MediaController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        if ( ! KyotoUser::hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        $query = Media::where('parent_id',
            $request->query('parent') ?: null);

        return response()->json($query->datatable());
    }

    public function show(Request $request)
    {
        $id = $request->query('id', null);

        $language = new Media;

        if ( ! empty($id) ) {
            $language = Media::findOrFail($id);
        }

        return response()->json([
            'data' => $language->toArray()
        ]);
    }

    public function store(MediaRequest $request)
    {
        $language = Media::create($request->input());

        // Save entity
        $language->save();

        return response()->json([
            'data' => $language->toArray(), 'message' => trans('Media has been created')
        ]);
    }

    public function update(MediaRequest $request)
    {
        $id = $request->query('id');

        $language = Media::findOrFail($id);

        $language->fill($request->input())
            ->save();

        return response()->json([
            'data' => $language, 'message' => trans('Media has been updated')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Media::findOrFail($id)->forceDelete();
        }

        return response()->json([
            'data' => [], 'message' => trans('Medias have been deleted')
        ]);
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');

        $data = array_merge($request->input(), [
            'id' => uuid(), 'file' => $file->store('source', 'media')
        ]);

        $data['type'] = $file->getMimeType();

        $data['title'] = pathinfo($file->getClientOriginalName(),
            PATHINFO_FILENAME);

        (new Media)->fill($data)->save();

        return response()->json([
            'data' => [], 'info' => trans('Media has been uploaded')
        ]);
    }

}
