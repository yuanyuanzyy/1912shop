<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    public function logindo(Request $request){
        $post=request()->all();
        //更具用户名查询记录
        $admin=Admin::where('admin_name',$post['admin_name'])->first();
        if(!$admin){
            return redirect('/login')->with('msg','用户名或密码不对');
        }
        if(decrypt($admin->admin_pwd)!=$post['admin_pwd']){
          return  redirect('/login')->with('msg','用户名或密码不对');

        }
        request()->session()->put('admin',$admin);

        if(isset($post['remder'])){
            Cookie::queue('admin', serialize($admin),60*24*7);
        }
        return redirect('/book/create');
    }
}
