<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class TestController extends Controller
{
    public function index(){

    	return view('add');
    }
    public function adddo(){
    	
    	echo "提交成功";
    }
    //设置cookie
     public function setcookie(){
     	//第一种设置cookie
    	//return response('欢迎来到 Laravel 学院')->cookie( 'name', '学院', 2 );
   		//第二种设置cookie
    	//Cookie::queue(Cookie::make('user', 'lisi',10));
    	//第三种设置cookie
    	Cookie::queue('user', 'zhangsan', 10);
    }

    //取cookie
    public function getcookie(Request $request){
     	//第一种取cookie
    	//dd($request->cookie('name'));
    	//第二种取cookie
    	dd(Cookie::get('user'));
    }
}

