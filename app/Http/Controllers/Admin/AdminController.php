<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreadminPost;
use App\Admin;
use Validator;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_name=request()->admin_name;
        $where=[];
        if($admin_name){
            $where[]=['admin_name','like',"%$admin_name%"];
        }
        $pageSize=config('app.pageSize');
        $admin=Admin::where($where)->paginate(2);
        return view('admin/admin/index',['admin'=>$admin,'admin_name'=>$admin_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin/admin/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreadminPost $request)
    {
        $admin=$request->except('_token');
       
        $validator = Validator::make($request->all(),
         [ 'admin_name' => 'required|unique:admin',
          'admin_pwd' => 'required', 
         ]);
        //文件上传
        if ($request->hasFile('my_img')) { 
            $my_img=uploads('my_img');
        }
        $admin_model=new Admin;
        $admin_model->admin_name=$request->admin_name;
        $admin_model->admin_pwd=$request->admin_pwd;
        if(isset($my_img)){
            $admin_model->my_img=$my_img;
        }
       $admin_model->email=$request->email;
        $admin_model->tel=$request->tel;
        $admin=$admin_model->save();
        if($admin){
            return redirect('admin');
        }
        
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin=Admin::where('admin_id',$id)->first();
       return view('admin/admin/edit',['admin'=>$admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreadminPost $request, $id)
    {
        $admin=$request->except('_token');
        $validator = Validator::make($request->all(),
         [ 'admin_name' => 'required|unique:admin',
          'admin_pwd' => 'required', 
         ]);
        //文件上传
        if ($request->hasFile('my_img')) { 
            $my_img=uploads('my_img');
        }
        $admin_model=new Admin;
        $admin_model->admin_name=$request->admin_name;
        $admin_model->admin_pwd=$request->admin_pwd;
        if(isset($my_img)){
            $admin_model->my_img=$my_img;
        }
        $admin_model->email=$request->email;
        $admin_model->tel=$request->tel;
        $admin=$admin_model->save();
        if($admin){
            return redirect('admin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin=Admin::destroy($id);
        if($admin){
            return redirect('admin');
        }
    }
    public function checkname(){
        $admin_name=request()->admin_name;
        $count=Admin::where('admin_name',$admin_name)->count();
        return json_encode(['code'=>'00000','count'=>$count]);
    }
}
