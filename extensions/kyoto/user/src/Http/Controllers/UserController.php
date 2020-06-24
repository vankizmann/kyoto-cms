<?php

namespace Kyoto\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Kyoto\User\Models\User;

class UserController extends Controller
{

    public function index()
    {
        if ( ! app('kyoto.user')->hasPolicyAction([self::class, 'index']) ) {
            abort(403);
        }

        return response()->json(User::datatable());
    }

}
