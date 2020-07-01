<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Category;
//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    public function index(){
        //幻灯片数据读取
        //$slice=Cache::get('slice');
        //Redis::flushall();
        $slice=Redis::get('slice');
        //dump($slice);
        if(!$slice){
            $where=[
                'is_up'=>1,
                'is_postion'=>1
            ];
        	$slice=Goods::select('goods_id','goods_img')
            ->where($where)
            ->take(5)
            ->orderBy('goods_id','desc')
            ->get();
           // Cache::put('slice',$slice,24*60*60);
            $slice=serialize($slice);
            Redis::setex('slice',24*60*60,$slice);
        }
        $slice=unserialize($slice);
        //顶级分类
       // $topcate=Cache::get('topcate');
         $topcate=Redis::get('topcate');
        if(!$topcate){
        $wh=[
            'pid'=>0
        ];
        $topcate=Category::where($wh)->take(4)->get();
         //Cache::put('topcate',$topcate,24*60*60);
         $topcate=serialize($topcate);
         Redis::setex('topcate',24*60*60,$topcate);
        }
         $topcate=unserialize($topcate);


         $goods=Redis::get('goods');
        //$goods=Cache::get('goods');
        if(!$goods){
        $where=[
            'is_up'=>1,
            'is_hot'=>1
        ];
         $goods=Goods::where($where)->take(4)->get();
          //Cache::put('goods',$goods,24*60*60);
         $goods=serialize($goods);
         Redis::setex('goods',24*60*60,$goods);
        }
         $goods=unserialize($goods);
    	return view('index/index',['goods'=>$goods,'slice'=>$slice,'topcate'=>$topcate]);
    }
    public function prolist(){
    	$goods=Goods::get();
    	return view('index/prolist',['goods'=>$goods]);
    }
    

}
