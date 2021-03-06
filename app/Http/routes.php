<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/hi', function () {
    $msg='账号或密码错误';
    //return view('user.login',compact('msg'));
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::any('/wechat', 'WechatController@serve');


Route::any('/upload.php', 'wap\ArticleController@upload');

Route::any('/test', 'FileController@upload');


Route::get('/master', function ()
{
    return view('master');
});

Route::get('/mail', function ()
{
    Mail::raw('test mail', function ($m) {
        $m->from('lihongcheng@fnjr2017.com', 'User');
        $m->to('343739868@qq.com')->subject('test email');
    });
    return 1;
});


Route::any('/u', 'FileController@upload');
Route::any('/upload.php', 'FileController@upload');
//
Route::group(['middleware' => ['web']], function () {

    Route::get('/w', 'wap\ArticleController@index');

    Route::get('/u', 'wap\ArticleController@up');
    Route::any('/uu', 'wap\ArticleController@uploader');
    Route::post('/u/uploader', 'wap\ArticleController@uploader');
    Route::any('/uu/uploader', 'wap\ArticleController@uploader');



//    Route::get('/u', 'wap\ArticleController@upload');


 //   Route::get('/', 'IndexController@index');
    Route::post('/login','MyuserControllger@login');

    Route::get('/', 'ArticleController@index');
    Route::get('/article/{id}', 'ArticleController@show');

    Route::get('/fenlei/{id}', 'ArticleController@fenlei');

    Route::get('/create', 'ArticleController@create');
    Route::post('/create1', 'ArticleController@create1');

    Route::get('/logout','MyuserController@logout');

    Route::get('/register','MyuserController@register');
    Route::post('/store','MyuserController@store');

    Route::get('/login','MyuserController@login');
    Route::post('/login1','MyuserController@login1');

    Route::get('/myinfo','MyuserController@myinfo');
});
