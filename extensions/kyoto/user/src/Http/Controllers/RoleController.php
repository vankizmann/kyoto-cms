<?php

namespace Kyoto\User\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\User\Models\Role;
use Kyoto\User\Http\Requests\RoleRequest;

class RoleController extends \App\Http\Controllers\Controller
{
    public function total()
    {
        return response()->json(Role::all());
    }

    public function index()
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(Role::datatable());
    }

    public function show(Request $request)
    {
        $id = $request->query('id', null);

        $role = new Role;

        if ( ! empty($id) ) {
            $role = Role::findOrFail($id);
        }

        return response()->json([
            'data' => $role->toArray()
        ]);
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create($request->input());

        return response()->json([
            'data' => $role->toArray(), 'message' => trans('Role has been created')
        ]);
    }

    public function update(RoleRequest $request)
    {
        $id = $request->query('id');

        $role = Role::findOrFail($id);

        $role->fill($request->input())
            ->save();

        return response()->json([
            'data' => $role, 'message' => trans('Role has been updated')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            Role::findOrFail($id)->forceDelete();
        }

        return response()->json([
            'data' => [], 'message' => trans('Roles have been deleted')
        ]);
    }

}
