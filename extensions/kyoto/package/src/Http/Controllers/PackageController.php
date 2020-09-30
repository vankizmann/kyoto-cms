<?php

namespace Kyoto\Package\Http\Controllers;
use Kyoto\Application\Facades\Kyoto;
use Kyoto\Menu\Facades\Connector;

class PackageController extends \App\Http\Controllers\Controller
{
    public function connector()
    {
        $data = [];

        foreach ( Connector::keys() as $key ) {
            $data[] = ['label' => Kyoto::localize($key), 'value' => $key];
        }

        return response()->json($data);
    }
}
