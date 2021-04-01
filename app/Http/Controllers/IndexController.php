<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\People;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    //
    public function execute(Request $request)
    {
        if($request->isMethod('POST')) {
            $messages = array(
                'required' => 'Поло обовязкове для заповнення',
                'email' => 'Поле має відповідати email'
            );
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'text' => 'required'
            ], $messages);
            $data = $request->all();
            $mail_admin = 'alll@dfgdf.com';
            $result = Mail::to($mail_admin);/*
                            /*->from($data['email'],$data['name'])
                            ->send('site.email',['data'=>$data]);*/

            /*send('site.email', ['data' => $data], function ($message) use ($data) {
                $mail_admin = env('MAIL_ADMIN');
                $message->from($data['email'], $data['name']);
                $message->to($mail_admin)->subject('Question');
            });*/
            if ($result) {
                return redirect()->route('home')->with('status', 'Email is send');
            }
        }


        $pages = Page::all();
        $portfolio = Portfolio::get(array('name','filter','images'));
        $services = Service::all();
        $peoples = People::all();

        $tags = DB::table('portfolios')->distinct()->pluck('filter');


        $menu = array();

        foreach ($pages as $page)
        {
            $item = array('title'=>$page->name,
                            'alias'=>$page->alias
                        );
            array_push($menu,$item);
        }
        $item = array('title'=>'Services','alias'=>'service');
        array_push($menu,$item);
        $item = array('title'=>'Portfolio','alias'=>'Portfolio');
        array_push($menu,$item);
        $item = array('title'=>'Team','alias'=>'team');
        array_push($menu,$item);
        $item = array('title'=>'Contact','alias'=>'contact');
        array_push($menu,$item);



            return view('site.index',array(
                                            'menu'=>$menu,
                                            'pages'=>$pages,
                                            'services'=>$services,
                                            'portfolio'=>$portfolio,
                                            'peoples'=>$peoples,
                                            'tags'=>$tags
                                        ));
    }
}
