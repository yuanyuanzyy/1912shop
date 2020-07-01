<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Goods;
use App\brand;
use App\category;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods_name=request()->goods_name;
        $where=[];
        if($goods_name){
            $where[]=['goods_name','like',"%$goods_name%"];
        }
        $pageSize=config("app.pageSize");
        $goods=goods::where($where)->paginate($pageSize);
        //dd($goods);
        return view('admin/goods/index',['goods'=>$goods,'goods_name'=>$goods_name]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        
         //dd($brand);

        return view('admin/goods/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $goods=$request->except('_token');
       if($request->hasFile('goods_img')){
        //文件上传
        $goods_img=uploads('goods_img');
        //var_dump($img);
     }
        $GoodsModel=new Goods;
        $GoodsModel->goods_name=$request->goods_name;
        $GoodsModel->goods_price=$request->goods_price;
        $GoodsModel->goods_desc=$request->goods_desc;
        $GoodsModel->goods_num=$request->goods_num;
        if(isset($goods_img)){
          $GoodsModel->goods_img=$goods_img;
        }
        $GoodsModel->is_new=$request->is_new;
        $res=$GoodsModel->save();
         if($res){
             return redirect('goods');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

         $goods=Goods::where('goods_id',$id)->first();
         return view('admin/goods/edit',['goods'=>$goods]);
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
         $goods=$request->except('_token');
         if($request->hasFile('goods_img')){
        //文件上传
        $goods_img=uploads('goods_img');
        //var_dump($img);
        }
        $GoodsModel=Goods::find($id);
        $GoodsModel->goods_name=$request->goods_name;
        $GoodsModel->goods_price=$request->goods_price;
        $GoodsModel->goods_desc=$request->goods_desc;
        $GoodsModel->goods_num=$request->goods_num;
         if(isset($goods_img)){
          $GoodsModel->goods_img=$goods_img;
        }
        $GoodsModel->is_new=$request->is_new;
        $res=$GoodsModel->save();
         if($res){
            return redirect('goods');
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
        $res=Goods::destroy($id);
        if($res){
            return redirect('goods');
        }
    }
     public function checkname(){
        $goods_name=request()->goods_name;
        $count=Goods::where('goods_name',$goods_name)->count();
        return json_encode(['code'=>'00000','count'=>$count]);
    }
}
