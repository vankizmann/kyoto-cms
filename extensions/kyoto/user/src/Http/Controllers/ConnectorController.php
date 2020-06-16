<?php

namespace Kyoto\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kyoto\User\Http\Requests\LoginRequest;

class ConnectorController extends Controller
{

    public function login(Request $request)
    {
        return view('kyoto/user::login');
    }

    public function postLogin(LoginRequest $request)
    {
        $data = $request->only([
            'email', 'password'
        ]);

        if ( ! Auth::attempt($data) ) {
            return back()->withInput()->with('error', trans('Invalid email or password.'));
        }

        return redirect('/backend');
    }

}
