<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/bb', function () {
    echo "134";
});
Route::get('/cc', function (){
    echo "134";
});
//Route::permanentRedirect('/index', '/aa',302);
Route::redirect('/bb', '/cc', 302);

//定义控制器的路由
Route::get('setcookie','TestController@setcookie');
Route::get('getcookie','TestController@getcookie');


Route::get('/test','TestController@index');
Route::post('/adddo','TestController@adddo');

// Route::get('/list','StudentController@index');
// Route::post('/store','StudentController@store');

//Route::match(['get','post'],'create','StudentController@create');
// Route::any('create','StudentController@create');

Route::get('/shu','Shuzu@index');

//品牌模块的增删改查
Route::domain('admin.qqq.com')->group(function(){
Route::prefix('brand')->middleware('islogin')->group(function(){
	Route::get('create','Admin\BrandController@create');
	Route::post('store','Admin\BrandController@store');
	Route::get('/','Admin\BrandController@index');
	Route::get('destroy/{id}','Admin\BrandController@destroy');
	Route::get('edit/{id}','Admin\BrandController@edit');
	Route::post('update/{id}','Admin\BrandController@update');
  Route::get('/checkname','Admin\BrandController@checkname');
  Route::get('del/','Admin\BrandController@del');
});
//学校模块的增删改查 445897400 448705114
// Route::prefix('student')->group(function(){
//     Route::get('create','Admin\StudentController@create');
//     Route::post('store','Admin\StudentController@store');
//     Route::get('/','Admin\StudentController@index');
//     Route::get('destroy/{id}','Admin\StudentController@destroy');
// });
//分类
Route::prefix('category')->middleware('islogin')->group(function(){
  Route::get('create','Admin\CategoryController@create');
  Route::post('store','Admin\CategoryController@store');
  Route::get('/','Admin\CategoryController@index');
  Route::get('destroy/{id}','Admin\CategoryController@destroy');
  Route::get('edit/{id}','Admin\CategoryController@edit');
  Route::post('update/{id}','Admin\CategoryController@update');
  Route::get('/checkname','Admin\CategoryController@checkname');
});
//商品
Route::prefix('goods')->middleware('islogin')->group(function(){

 Route::get('create','Admin\GoodsController@create');
 Route::post('store','Admin\GoodsController@store');
 Route::get('/','Admin\GoodsController@index');
 Route::get('destroy/{id}','Admin\GoodsController@destroy');
 Route::get('gedit/{id}','Admin\GoodsController@edit');
 Route::post('update/{id}','Admin\GoodsController@update');
 Route::get('/checkname','Admin\GoodsController@checkname');
});
//管理员
Route::prefix('admin')->middleware('islogin')->group(function(){
 Route::get('create','Admin\AdminController@create');
 Route::post('store','Admin\AdminController@store');
 Route::get('/','Admin\AdminController@index');
 Route::get('destroy/{id}','Admin\AdminController@destroy');
 Route::get('edit/{id}','Admin\AdminController@edit');
 Route::post('update/{id}','Admin\AdminController@update');
 Route::get('/checkname','Admin\AdminController@checkname');
});

//登录
 Route::view('/login','admin.login');
 Route::post('/logindo','Admin\LoginController@logindo');
//网站
Route::prefix('wangzhan')->middleware('islogin')->group(function(){
 Route::get('create','Admin\WangzhanController@create');
 Route::post('store','Admin\WangzhanController@store');
 Route::get('/','Admin\WangzhanController@index');
 Route::get('destroy/{id}','Admin\WangzhanController@destroy');
 Route::get('edit/{id}','Admin\WangzhanController@edit');
 Route::post('update/{id}','Admin\WangzhanController@update');
});

 Route::get('user/create','Admin\UserController@userdo');
 Route::post('user/useradd','Admin\UserController@useradd');
//文章
Route::prefix('book')->middleware('islogin')->group(function(){
 Route::get('create','Admin\BookController@create');
 Route::post('store','Admin\BookController@store');
 Route::get('/','Admin\BookController@index');
 Route::match(['post','get'],'destroy/{id}','Admin\BookController@destroy');
 Route::get('edit/{id}','Admin\BookController@edit');
 Route::post('update/{id}','Admin\BookController@update');

 Route::get('/checkname','Admin\BookController@checkname');
});
});



//前台展示
Route::domain('www.qqq.com')->group(function(){
Route::get('/','Index\IndexController@index');
Route::get('/login','Index\LoginController@login');
Route::get('/reg','Index\LoginController@reg');
//发送邮件
Route::get('/send','Index\LoginController@send');
//注册
Route::post('/regadd','Index\LoginController@regadd');
//登录
Route::post('/loginadd','Index\LoginController@loginadd');
Route::post('/denglu','Index\LoginController@denglu');

Route::get('/prolist/{cate_id}/{type?}','Index\CategoryController@prolist');
Route::get('/cat','Index\CatController@cat');
Route::get('/proinfo/{id}','Index\GoodsController@proinfo');
Route::get('/addcat','Index\GoodsController@addcat');
//Route::get('/list/{id}','Index\CategoryController@index');


});


