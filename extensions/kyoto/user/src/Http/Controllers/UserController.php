<?php

namespace Kyoto\User\Http\Controllers;

use Illuminate\Http\Request;
use Kyoto\User\Models\User;
use Kyoto\User\Http\Requests\UserRequest;

class UserController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(User::datatable());
    }

    public function show(Request $request)
    {
        $id = $request->query('id', null);

        $user = new User;

        if ( ! empty($id) ) {
            $user = User::findOrFail($id);
        }

        return response()->json([
            'data' => $user->toArray()
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->input());

        return response()->json([
            'data' => $user->toArray(), 'message' => trans('User has been created!')
        ]);
    }

    public function update(UserRequest $request)
    {
        $id = $request->query('id');

        $user = User::findOrFail($id);

        $user->fill($request->input())
            ->save();

        return response()->json([
            'data' => $user, 'message' => trans('User has been updated!')
        ]);
    }

    public function delete()
    {
        foreach ( request()->input('ids', []) as $id ) {
            User::findOrFail($id)->forceDelete();
        }

        return response()->json([
            'data' => [], 'message' => trans('Users has been deleted!')
        ]);
    }

}
