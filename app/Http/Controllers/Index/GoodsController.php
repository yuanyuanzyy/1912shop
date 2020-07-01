<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Car;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
     public function proinfo($goods_id){
        $count=Redis::setnx('count_'.$goods_id,1)?:Redis::incr('count_'.$goods_id);
    	
    	$goods=Goods::find($goods_id);
    	return view('index/proinfo',['goods'=>$goods,'count'=>$count]);
    }
    //1: 判断 有没有登录 没：则登录 
    //2：判断商品是否上下架 下架：提示 
    //3 判断购买数量是否大于库存 大了：提示库存不足 
    //4 判断之前用户有无添加过添加商品  
    //添加过 ：购买数量  相加 ；加完后再判断库存  
    //没有添加过：直接入库
    public function addcat(Request $request){
       $goods_id=$request->goods_id;
       $buy_num=$request->buy_num;
       //判断用户是否登录
       $user=session('login');
       //dd($user);
       if(!$user){
       	 	return response()->json(['code'=>'00001','msg'=>'请先登录']);
       }
       //判断商品是否上下架  如果下架给出提示
       $goods=Goods::find($goods_id);
       if($goods->is_up!=1){
       		return response()->json(['code'=>'00002','msg'=>'商品已下架']);
       }
       //判断购买数量是否大于库存 
       if($buy_num>$goods['goods_num']){
       	    return response()->json(['code'=>'00003','msg'=>'商品库存不足']);
       }
       //4.判断之前用户有无添加过添加商品  
       //添加过 ：购买数量  相加 ；加完后再判断库存  
       //没有添加过：直接入库

       $where=[
       		'user_id'=>$user->m_id,
       		'goods_id'=>$goods_id
       ];
       $car=Car::where($where)->first();
       if(!$car){
       		$data=[
       			'user_id'=>$user->m_id,
       		    'goods_id'=>$goods_id,
       		    'buy_num'=>$buy_num,
       		    'goods_name'=>$goods->goods_name,
       		    'goods_img'=>$goods->goods_img,
       		    'goods_price'=>$goods->goods_price
       		];
       		$res=Car::create($data);
       		dd($res);
       }else{
       		$buy_num+=$car->buy_num;
       		if($buy_num>$goods['goods_num']){
       	    	$buy_num=$goods['goods_num'];
            }
             $res=Car::where($where)->update(['buy_num'=>$buy_num]);
       }
       if($res){
       		return response()->json(['code'=>'00000','msg'=>'加入成功']);
       }


    }
    public function cat(){
    	
    }
    
}
