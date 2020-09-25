<?php

namespace Kyoto\User\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\User\Models\Gate;
use Kyoto\User\Http\Requests\GateRequest;

class GateController extends \App\Http\Controllers\Controller
{
    public function total()
    {
        return response()->json(Gate::all());
    }

    public function index()
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(Gate::datatree());
    }

    public function show(Request $request)
    {
        $id = $request->query('id', null);

        $gate = new Gate;

        if ( ! empty($id) ) {
            $gate = Gate::findOrFail($id);
        }

        return response()->json([
            'data' => $gate->toArray()
        ]);
    }

    public function store(GateRequest $request)
    {
        $gate = Gate::create($request->input());

        return response()->json([
            'data' => $gate->toArray(), 'message' => trans('Gate has been created!')
        ]);
    }

    public function update(GateRequest $request)
    {
        $id = $request->query('id');

        $gate = Gate::findOrFail($id);

        $gate->fill($request->input())
            ->save();

        return response()->json([
            'data' => $gate, 'message' => trans('Gate has been updated!')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Gate::findOrFail($id)->forceDelete();
        }

        return response()->json([
            'data' => [], 'message' => trans('Gates has been deleted!')
        ]);
    }

}
