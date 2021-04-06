<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Page;

class PageAddController extends Controller
{
    //
    public function execute (Request $request)
    {
        if($request->isMethod('post')) {
            $input = $request->except('_token');

            $messages = array(
                'required' => "Поле :attribute обов'язкове до заповнення",
                'unique' => 'Поле :attribute повинне бути унікальним'
            );

            $validator = Validator::make($input, array(
                'name' => 'required|max:255',
                'alias' => 'required|unique:pages|max:255',
                'text' => 'required|max:10000'
            ),$messages);
            if ($validator->fails()) {
                return redirect()->route('pageAdd')->withErrors($validator)->withInput();
            }
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $input['images'] = $file->getClientOriginalName();
               // dd(public_path('\assets\img'));
                $file->move(public_path('assets\img'),$input['images']);
                //$file->storePubliclyAs(public_path('\assets\img'),$input['images'],'pub');
               }
            $page = new Page();
            $page->fill($input);
            if ($page->save())
            {
                return redirect('admin')->with('status','Сторінка додана');
            }
        }
        if(view()->exists('admin.page_add'))
        {
            $data = array(
                'title' => 'Нова сторінка'
            );
            return view('admin.page_add',$data);
        }
        abort(404);
    }
}
