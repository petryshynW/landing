<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PageController;
use  App\Http\Controllers\PagesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([],function(){
    Route::match(['get','post'],'/',[IndexController::class, 'execute'])->name('home');
    Route::get('/page/{alias}',[PageController::class,'execute'])->name('page');

    //Route::match(['get','post'],'admin/',['uses'=>'AuthController']);
});
Route::match(['get','post'],'/auth',['uses'=>'Auth\AuthenticatedSessionController@create','as'=>'login']);
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::get('/',function(){
        if (view()->exists('admin.index'))
        {
            $data = ['title'=>'Панель адміна'];
            return view('admin.index',$data);
        }
        return view();
    });

    //PAGES
    Route::group(['prefix'=>'pages'],function(){
        Route::get('/',[PagesController::class,'execute'])->name('pages');
        Route::match(['get','post'],'/add',['uses'=>'PagesAddController@execute','as'=>'pagesAdd']);
        Route::match(['get','post','delete'],'/edit/{page}',['uses'=>'PagesEditController@execute','as'=>'pagesEdit']);

    });
    //PORTFOLIO
    Route::group(['prefix'=>'portfolio'],function(){
        Route::get('/',['uses'=>'PortfolioController@execute','as'=>'portfolio']);
        Route::match(['get','post'],'/add',['uses'=>'PortfolioAddController@execute','as'=>'portfolioAdd']);
        Route::match(['get','post','delete'],'/edit/{portfolio}',['uses'=>'PortfolioEditController@execute','as'=>'portfolioEdit']);

    });
    //SERVICES
    Route::group(['prefix'=>'services'],function(){
        Route::get('/',['uses'=>'ServiceController@execute','as'=>'services']);
        Route::match(['get','post'],'/add',['uses'=>'ServicesAddController@execute','as'=>'sericeAdd']);
        Route::match(['get','post','delete'],'/edit/{service}',['uses'=>'ServiceEditController@execute','as'=>'servicesEdit']);

    });
});
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
