<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //session使用
       //存
        // session(['name'=>'list']);
        // request()->session()->put('namber',100);
        // //取
        // echo session('name');
        // dump(request()->session()->get('namber'));
        // //如果没有值就设置默认值
        // dump(session('city','北京'));
        // dump(request()->session()->get('country','中国'));
        // session(['city'=>null]);
        // //检查有没有值
        // dump(request()->session()->has('city'));
        // //检查有无此键
        // dump(request()->session()->exists('city'));

        // //单个删除
        //  dump(request()->session()->forget('namber'));
        //  //删除所有
        //  dump(request()->session()->flush());
        //  //获取所有session
        //  dump(request()->session()->all());



       $cate=Category::orderBy('cate_id')->get();
       $cate=cateTree($cate);
       return view('admin/category/index',['cate'=>$cate]);
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
       
        $cate=Category::get();
        $cate=cateTree($cate);
        return view('admin/category/create',['cate'=>$cate]);
    }
    
    public function store(Request $request)
    {
        $category=$request->except('_token');
        $CateModel=new Category;
        $CateModel->cate_name=$request->cate_name;
        $CateModel->pid=$request->pid;
        $CateModel->cate_show=$request->cate_show;
        $CateModel->cate_show_nav=$request->cate_show_nav;
        $res=$CateModel->save();
        if($res){
            return redirect('category');
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
        $cate=Category::where('cate_id',$id)->first();
        $cateinfo=Category::get();
        return view('admin/category/edit',['cate'=>$cate,'cateinfo'=>$cateinfo]);
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
        $category=$request->except('_token');
        $CateModel=Category::find($id);
        $CateModel->cate_name=$request->cate_name;
        $CateModel->pid=$request->pid;
        $CateModel->cate_show=$request->cate_show;
        $CateModel->cate_show_nav=$request->cate_show_nav;
        $res=$CateModel->save();
        if($res){
            return redirect('category');
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
         //echo $id;
         $count=Category::where('pid',$id)->count();
         //dd($count);
         //Category::destroy($id);
         if($count>0){
            echo "<script>alert('该分类有子分类，不能删除此分类');history.go(-1)</script>";
            die;
         }
    }
     public function checkname(){
        $cate_name=request()->cate_name;
        $count=Category::where('cate_name',$cate_name)->count();
        return json_encode(['code'=>'00000','count'=>$count]);
    }
}
