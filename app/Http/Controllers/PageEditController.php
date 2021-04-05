<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageEditController extends Controller
{
    public function execute (Page $page, Request $request)
    {
        //$page = Page::find($id);
        $old = $page->toArray();
        if (view()->exists('admin.page_edit'))
        {
            $data = array(
                'title' => 'Редагування сторінки - '.$old['name'],
                'data' => $old
            );
            return view('admin.page_edit', $data);
        }
        abort(404);
    }
}
