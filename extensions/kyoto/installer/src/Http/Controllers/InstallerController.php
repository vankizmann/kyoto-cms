<?php

namespace Web\Kyoto\Installer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstallerController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index()
    {
        return view('kyoto/installer::default');
    }

    public function laravel(Request $req)
    {
        if ( ! $req->input('APP_NAME') ) {
            return response()->json(null, 418);
        }

        return response()->json(null, 200);
    }

    public function database(Request $req)
    {
        $opts = [
            $req->input('DB_HOST'), $req->input('DB_USERNAME'), $req->input('DB_PASSWORD')
        ];

        try {
            // Test basic connection
            $mysqli =  new \mysqli(...$opts);

            // Test database name
            if ( ! $mysqli->select_db($req->input('DB_NAME')) ) {
                throw new \Exception;
            }

        } catch (\Exception $exception) {
            return response()->json(null, 418);
        }

        return response()->json(null, 200);
    }

    public function website(Request $req)
    {
        if ( ! $req->input('KYO_TITLE') ) {
            return response()->json(null, 418);
        }

        if ( ! $req->input('KYO_USER') ) {
            return response()->json(null, 418);
        }

        if ( ! $req->input('KYO_PASS') ) {
            return response()->json(null, 418);
        }

        if ( ! $req->input('KYO_MAIL') ) {
            return response()->json(null, 418);
        }

        return response()->json(null, 200);
    }
}
