<?php

namespace Kyoto\Page\Http\Controllers;

class WidgetController extends \App\Http\Controllers\Controller {

    public function list()
    {
        $widgets = app('kyoto.widget')->getWidgets();

        return response()->json($widgets);
    }

}
