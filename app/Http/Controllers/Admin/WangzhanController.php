<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Wangzhan;
use Validator;

class WangzhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wname=request()->wname;
        $where=[];
        if($wname){
            $where[]=['wname','like',"%$wname%"];
        }
        $pageSize=config('app.pageSize');
        $res=Wangzhan::where($where)->paginate($pageSize);
        return view('admin/wangzhan/index',['res'=>$res,'wname'=>$wname]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/wangzhan/create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $wang=request()->except('_token');
        if ($request->hasFile('wimg')) { 

            $wimg=uploads('wimg');
            //dd($wimg);
        }

        $validator = Validator::make($request->all(),[ 
         'wname' => 'required|unique:wangzhan',
          'wurl' => 'required',
        ],[
        'wname'.'required'=>'网站名称不能为空',
        'wname'.'unique'=>'网站名称已存在',
        'wurl'.'required'=>'网站网址不能为空',

        ]);
        if ($validator->fails()) {
         return redirect('wangzhan/create') 
         ->withErrors($validator) 
         ->withInput(); 
        }
        $WangModel=new Wangzhan;
        $WangModel->wname=$request->wname;
        $WangModel->wurl=$request->wurl;
        $WangModel->wlei=$request->wlei;
        if(isset($wimg)){
            $WangModel->wimg=$wimg;
        }
        $WangModel->wuname=$request->wuname;
        $WangModel->wdesc=$request->wdesc;
        $WangModel->is_show=$request->is_show;
        $res=$WangModel->save();
           if($res){
            return redirect('wangzhan');
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
        $res=Wangzhan::where('id',$id)->first();
        return view('admin/wangzhan/edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $wang=request()->except('_token');
        if ($request->hasFile('wimg')) { 

            $wimg=uploads('wimg');
            //dd($wimg);
        }

        $validator = Validator::make($request->all(),[ 
         'wname' => 'required|unique:wangzhan',
          'wurl' => 'required',
        ],[
        'wname'.'required'=>'网站名称不能为空',
        'wname'.'unique'=>'网站名称已存在',
        'wurl'.'required'=>'网站网址不能为空',

        ]);
        if ($validator->fails()) {
         return redirect('wangzhan/update') 
         ->withErrors($validator) 
         ->withInput(); 
        }
        $WangModel=Wangzhan::find($id);
        $WangModel->wname=$request->wname;
        $WangModel->wurl=$request->wurl;
        $WangModel->wlei=$request->wlei;
        if(isset($wimg)){
            $WangModel->wimg=$wimg;
        }
        $WangModel->wuname=$request->wuname;
        $WangModel->wdesc=$request->wdesc;
        $WangModel->is_show=$request->is_show;
        $res=$WangModel->save();
         if($res){
            return redirect('wangzhan');
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
        $res=Wangzhan::destroy($id);
        if($res){
            return redirect('wangzhan');
        }
    }
}
