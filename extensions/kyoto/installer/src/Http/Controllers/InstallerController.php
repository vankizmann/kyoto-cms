<?php

namespace Kyoto\Installer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Kyoto\Support\Env\EnvEditor;

class InstallerController extends Controller
{
    public function __construct()
    {
        if ( app('kyoto')->isReady() ) {
            abort(404);
        }

        $this->middleware('web');
    }

    public function index()
    {
        return view('kyoto/installer::default');
    }

    public function env()
    {
        $env = new EnvEditor;

        $data = [

            'APP_NAME'      => $env->get('APP_NAME', 'Laravel'),
            'APP_ENV'       => $env->get('APP_ENV', 'local'),
            'APP_DEBUG'     => $env->get('APP_DEBUG', false),
            'APP_URL'       => $env->get('APP_URL', ''),
            'APP_KEY'       => $env->get('APP_KEY', ''),

            'DB_DATABASE'   => $env->get('DB_DATABASE', 'laravel'),
            'DB_USERNAME'   => $env->get('DB_USERNAME', 'root'),
            'DB_PASSWORD'   => $env->get('DB_PASSWORD', 'root'),
            'DB_HOST'       => $env->get('DB_HOST', 'localhost'),

            'KYO_TITLE'     => $env->get('KYO_TITLE', ''),
            'KYO_USERNAME'  => $env->get('KYO_USERNAME', 'admin'),
            'KYO_PASSWORD'  => $env->get('KYO_PASSWORD', ''),
            'KYO_EMAIL'     => $env->get('KYO_EMAIL', ''),

        ];

        if ( empty($data['APP_URL']) ) {
            $data['APP_URL'] = request()->getSchemeAndHttpHost();
        }

        return response()->json($data, 200);
    }

    public function laravel(Request $req)
    {
        if ( ! $req->input('APP_NAME') ) {
            return response()->json(null, 418);
        }

        $env = new EnvEditor;

        $env->set('APP_NAME', $req->input('APP_NAME'));
        $env->set('APP_ENV', $req->input('APP_ENV'));
        $env->set('APP_DEBUG', $req->input('APP_DEBUG'));
        $env->set('APP_URL', $req->input('APP_URL'));
        $env->set('APP_KEY', $req->input('APP_KEY'));

        $env->save();

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
            if ( ! $mysqli->select_db($req->input('DB_DATABASE')) ) {
                throw new \Exception;
            }

        } catch (\Exception $exception) {
            return response()->json(null, 418);
        }

        $env = new EnvEditor;

        $env->set('DB_DATABASE', $req->input('DB_DATABASE'));
        $env->set('DB_HOST', $req->input('DB_HOST'));
        $env->set('DB_USERNAME', $req->input('DB_USERNAME'));
        $env->set('DB_PASSWORD', $req->input('DB_PASSWORD'));
        $env->set('DB_PREFIX', $req->input('DB_PREFIX'));

        $env->save();

        return response()->json(null, 200);
    }

    public function website(Request $req)
    {
        if ( ! $req->input('KYO_TITLE') ) {
            return response()->json(null, 418);
        }

        if ( ! $req->input('KYO_USERNAME') ) {
            return response()->json(null, 418);
        }

        if ( ! $req->input('KYO_PASSWORD') ) {
            return response()->json(null, 418);
        }

        if ( ! $req->input('KYO_EMAIL') ) {
            return response()->json(null, 418);
        }

        $env = new EnvEditor;

        $env->set('KYO_TITLE', $req->input('KYO_TITLE'));
        $env->set('KYO_USERNAME', $req->input('KYO_USERNAME'));
        $env->set('KYO_PASSWORD', $req->input('KYO_PASSWORD'));
        $env->set('KYO_EMAIL', $req->input('KYO_EMAIL'));

        $env->save();

        return response()->json(null, 200);
    }

    public function setup()
    {
        set_time_limit(0);

        $env = new EnvEditor;

        try {

            $key = 'base64:EXjQjGJAPf/sF6p0u6e+psji7VdgiI6+OrQXF2c5S9A=';

            if ( $env->get('APP_KEY') === $key ) {

                // Generate new key
                Artisan::call('key:generate');
            }

            // Mirgate database
            Artisan::call('migrate:refresh', [
                '--path' => 'database/migrations'
            ]);

            foreach ( app('kyoto.extension')->getActiveConfigs() as $config ) {
                $config->install();
            }

            app('kyoto')->setReady();

        } catch (\Exception $exception) {

            return response()->json($exception->getMessage(), 500);
        }

        return response()->json(null, 200);
    }
}
