<?php

namespace Kyoto\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Kyoto\User\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(Role::datatable());
    }

}
