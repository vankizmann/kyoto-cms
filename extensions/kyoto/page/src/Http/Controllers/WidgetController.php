<?php

namespace Kyoto\Page\Http\Controllers;

class WidgetController extends \App\Http\Controllers\Controller {

    public function list()
    {
        $widgets = app('kyoto.widget')->getWidgets();

        foreach ([0, 1, 2, 3, 4, 5, 6, 7] as $index) {
            $widgets['foo' . $index] = $widgets[array_keys($widgets)[0]];
            $widgets['foo' . $index]['title'] = 'foo' . $index;
            $widgets['bar' . $index] = $widgets[array_keys($widgets)[1]];
            $widgets['bar' . $index]['title'] = 'bar' . $index;
        }

        return response()->json($widgets);
    }

}
