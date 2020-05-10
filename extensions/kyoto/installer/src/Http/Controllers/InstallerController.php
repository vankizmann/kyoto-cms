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
            return response()->json(null, 500);
        }

        return response()->json(null, 200);
    }

    public function test($id)
    {
        dd($id);
    }
}
