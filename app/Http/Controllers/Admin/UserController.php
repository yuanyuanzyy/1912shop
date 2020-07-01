<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;
class UserController extends Controller
{
    public function userdo(Request $request){
       
         return view('admin/user/user');
    }
     public function useradd(Request $request){
       
        $post=request()->all();
        //更具用户名查询记录
        $admin=Admin::where('admin_name',$post['admin_name'])->first();
        if(!$admin){
            return redirect('/user')->with('msg','用户名或密码不对');
        }
        if(decrypt($admin->admin_pwd)!=$post['admin_pwd']){
          return  redirect('/user')->with('msg','用户名或密码不对');

        }
        request()->session()->put('admin',$admin);
        return redirect('/book/create');
    }
}
