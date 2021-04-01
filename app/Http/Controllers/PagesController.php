<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PagesController extends Controller
{
    public function execute()
    {
        if (view()->exists('admin.pages'))
        {
            $pages = Page::all();
            $data = array(
                'title' => 'Сторінки',
                'pages' => $pages
            );
            return view('admin.pages',$data);
        }
        abort(404);
    }
}
