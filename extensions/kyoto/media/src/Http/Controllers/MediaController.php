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
        $parent_id = ($request->query('parent') ?: null);

        if ( ! KyotoUser::hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        $data = Media::where('parent_id', $parent_id)
            ->datatable();

        $folders = $files = [];

        if ( $parent_id ) {
            $folders[] = Media::findOrNew($parent_id)
                ->getAttribute('above');
        }

        $data['breadcrumbs'] = Media::findOrNew($parent_id)
            ->getAncestorsAndSelf();

        foreach ( $data['data'] as $item ) {

            if ( $item['type'] === 'system/folder' ) {
                $folders[] = $item;
            }

            if ( $item['type'] !== 'system/folder' ) {
                $files[] = $item;
            }

        }

        $data['data'] = array_merge($folders, $files);

        return response()->json($data);
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

    public function move(Request $request)
    {
        $data = $request->only(['source', 'target', 'strategy']);

        if ( $data['strategy'] === 'root' ) {

            foreach ( (array) $data['source'] as $id ) {
                Media::findOrFail($id)->makeRoot();
            }

        }

        if ( $data['strategy'] === 'inner' ) {

            $targetNode = Media::find($data['target']);

            foreach ( (array) $data['source'] as $id ) {
                if ( ! $targetNode ) {
                    Media::findOrFail($id)->makeRoot();
                }
            }

            foreach ( (array) $data['source'] as $id ) {
                if ( $targetNode ) {
                    Media::findOrFail($id)->makeChildOf($targetNode);
                }
            }

        }

        if ( $data['strategy'] === 'before' ) {

            $targetNode = Media::findOrFail($data['target']);

            foreach ( (array) $data['source'] as $id ) {
                Media::findOrFail($id)->moveToLeftOf($targetNode);
            }

        }

        if ( $data['strategy'] === 'after' ) {

            $targetNode = Media::findOrFail($data['target']);

            foreach ( (array) $data['source'] as $id ) {
                Media::findOrFail($id)->moveToRightOf($targetNode);
            }

        }

        return response()->json([
            'data' => [], 'message' => trans('Medias have been moved')
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
