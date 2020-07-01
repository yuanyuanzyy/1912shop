<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;

class CatController extends Controller
{
    public function cat(){
    	// $goods=Goods::where('goods_id',$id)->first();
    	// return view('index/cat',['goods'=>$goods]);
    }
    
}
