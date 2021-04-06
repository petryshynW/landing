<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Validator;

class PageEditController extends Controller
{
    public function execute (Page $page, Request $request)
    {
        if ($request->isMethod('GET'))
        {
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

        if ($request->isMethod('post'))
        {
            $input = $request->except('_token');
            $validator = Validator::make($input,array(
                'name' => 'required|max:255',
                'alias' => 'required|max:255|unique:pages,alias,'.$input['id'],
                'text' => 'required'
            ));
            if ($validator->fails())
            {
                return redirect()
                    ->route('pageEdit',['page'=>$input['id']])
                    ->withErrors($validator);
            }
            if ($request->hasFile('images'))
            {
                $file = $request->file('images');
                $input['images'] = $file->getClientOriginalName();
                $file->move(public_path('assets\img'),$input['images']);

            }
            else
            {
                $input['images'] = $input['old_image'];
            }
            unset($input['old_image']);
            $page->fill($input);
            if ($page->update())
            {
                return redirect()->route('admin')->with('status','Сторніка оновлена');
            }
        }
        if ($request->isMethod('delete'))
        {
            $page->delete();
            return redirect('admin')->with('status','Сторінка видалена');
        }
    }
}
