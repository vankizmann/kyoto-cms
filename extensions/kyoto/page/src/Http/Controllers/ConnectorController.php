<?php

namespace Kyoto\Page\Http\Controllers;

use App\Http\Controllers\Controller;
use Kyoto\Application\Facades\Kyoto;
use Kyoto\Page\Models\Page;

class ConnectorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function page()
    {
        $foreign_id = Kyoto::getMenu('foreign_id', null);

        if ( empty($foreign_id) ) {
            abort(404);
        }

        $page = Page::findOrFail($foreign_id);

        if ( empty($page) ) {
            abort(404);
        }

        return view('kyoto/page::page', [
            'page' => $page
        ]);
    }

}
