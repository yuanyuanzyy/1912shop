<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Category;

class CategoryController extends Controller
{
    public function prolist($cate_id,$type=1){
    	 $orderfield='is_new';
    	 if($type==2){
    	 	$orderfield='goods_num';
    	 }
    	 if($type==3){
    	 	$orderfield='goods_price';
    	 }
    	$category=Category::all();
    	$cate_ids=cateTree($category,$cate_id);
    	$cate_ids=json_decode(json_encode($cate_ids),true);
    	$cate_ids=array_column($cate_ids,'cate_id');
    	array_unshift($cate_ids,$cate_id);
    	$goods=Goods::where(['is_up'=>1])
    	->whereIn('cate_id',$cate_ids)
    	->orderBy($orderfield,'desc')
    	->get();
    	return view('index/prolist',['goods'=>$goods,'cate_id'=>$cate_id,'type'=>$type]);


    }
    
}
