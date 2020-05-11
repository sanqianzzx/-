<?php

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

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;

Route::get('/', "IndexController@home");

Route::get('/gg', "IndexController@gg");

Route::get('/article/{id}',"IndexController@article");

Route::get("/fankui","IndexController@fankui");
Route::post('/fkdo',"IndexController@fkdo");

Route::get('/login',"IndexController@login");
Route::post('/logindo',"IndexController@logindo");
Route::get('/reg',"IndexController@reg");
Route::post('/regdo',"IndexController@regdo");
Route::post('/yz',"IndexController@yz");
Route::get('/uset',"IndexController@uset");
Route::post('/session',"IndexController@session");
Route::post('/aid',"IndexController@aid");
Route::post('/reviewadd',"IndexController@reviewadd");


//后台
Route::group(['middleware' => ['admin']], function () {
    //
    Route::get('/adminindex',"AdminController@index");
    
    Route::get('/userlist',"AdminController@userlist");

    //反馈
    Route::get('/userfk',"AdminController@userfk");
    Route::get('/fkdetails/{id}',"AdminController@fkdetails");
    Route::post('/a_fkdo',"AdminController@a_fkdo");
    
    //类别
    Route::get('/admintypeindex',"AdminController@typeindex");
    Route::get('/admintypeadd',"AdminController@typeadd");
    Route::post('/admintypeadddo',"AdminController@typeadddo");
    Route::post('/admintypedel',"AdminController@typedel");
    Route::post('/admintype_stu',"AdminController@type_stu");

    
    Route::get('/adminerror',"AdminController@adminerror");

    //公告
    Route::get('/gg_add',"AdminController@gg_add");
    Route::post('/gg_do',"AdminController@gg_do");


    //文章
    Route::get('/articleindex',"AdminController@articleindex");
    Route::get('/articleadd',"AdminController@articleadd");
    Route::post('/articlepage',"AdminController@articlepage");
    Route::post('/articleadddo',"AdminController@articleadddo");
    Route::post('/articledel',"AdminController@articledel");
    Route::post('/upload',"AdminController@upload");
    Route::get('/articleupdate/{id}',"AdminController@articleupdate");
    Route::post('/articleupdo',"AdminController@articleupdo");

    Route::get('/clear',"AdminController@clear");
});
//管理员列表
Route::get('/adminlist',"AdminController@adminlist")->middleware('root');
Route::get('/adminadd',"AdminController@adminadd")->middleware('root');
Route::post('/adminadddo',"AdminController@adminadddo")->middleware('root');
Route::post('/adminstu',"AdminController@adminstu")->middleware('root');
Route::post('/admindel',"AdminController@admindel")->middleware('root');
Route::get('/adminupdate/{id}',"AdminController@adminupdate")->middleware('root');
Route::post('/adminupdo',"AdminController@adminupdo")->middleware('root');
//退出登录
Route::get('/out',"AdminController@out");


Route::get('/adminlogin',"AdminController@login");
Route::post('/adminlogindo',"AdminController@logindo");