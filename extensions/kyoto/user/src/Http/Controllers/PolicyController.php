<?php

namespace Kyoto\User\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\User\Models\Policy;
use Kyoto\User\Http\Requests\PolicyRequest;

class PolicyController extends \App\Http\Controllers\Controller
{
    public function total()
    {
        return response()->json(Policy::all());
    }

    public function index()
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(Policy::datatable());
    }

    public function show(Request $request)
    {
        $id = $request->query('id', null);

        $policy = new Policy;

        if ( ! empty($id) ) {
            $policy = Policy::findOrFail($id);
        }

        return response()->json([
            'data' => $policy->toArray()
        ]);
    }

    public function store(PolicyRequest $request)
    {
        $policy = Policy::create($request->input());

        return response()->json([
            'data' => $policy->toArray(), 'message' => trans('Policy has been created')
        ]);
    }

    public function update(PolicyRequest $request)
    {
        $id = $request->query('id');

        $policy = Policy::findOrFail($id);

        $policy->fill($request->input())
            ->save();

        return response()->json([
            'data' => $policy, 'message' => trans('Policy has been updated')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Policy::findOrFail($id)->forceDelete();
        }

        return response()->json([
            'data' => [], 'message' => trans('Policys have been deleted')
        ]);
    }

}
