<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
use Validator;
use Illuminate\Validation\Rule;
use DB;
use Log;
use Illuminate\Support\Facades\Cache;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page=request()->page??1;
        $brand_name=request()->brand_name;
        $where=[];
        if($brand_name){
            $where[]=['brand_name','like',"%$brand_name%"];
        }
        //缓存 加上分页
        $brand=Cache::get('brand_'.$page);
       // dump($brand);
        //如果没有从数据库中取 在保存到memcache
        if(!$brand){

            echo "Db====";
       // $brand=DB::table('brand')->orderBy('id','desc')->get();
        //dump($brand);
        //orm操作
        $pageSize=config('app.pageSize');
        //DB::connection()->enableQueryLog();
        $brand=Brand::where($where)->orderBy('id','desc')->paginate($pageSize);
        // $log=DB::getQueryLog();
        // dd($log);
        Cache::put('brand_'.$page,$brand,60);
         }
        return view('admin/brand/index',['brand'=>$brand,'brand_name'=>$brand_name]);
    }

    /**
     * Show the form for creating a new resource.
     *展示添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/brand/create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandPost $request)
    {
       $brand=$request->except('_token');
       //dd($brand);
       //威尔杜有望特米
       // $validatedData = $request->validate([
       //  'brand_name' => 'required|unique:brand',
       //   'brand_url' => 'required', 
       //   ],[
       //      'brand_name.required'=>'品牌名称必填',
       //      'brand_name.unique'=>'品牌名称已存在',
       //      'brand_url.required'=>'品牌网址必填',
       //   ]);
       //第三种验证
       $validator= Validator::make($request->all(), [
          'brand_name' => 'required|unique:brand',
          'brand_url' => 'required', 
          ],[
             'brand_name.required'=>'品牌名称必填',
             'brand_name.unique'=>'品牌网址已存在',
             'brand_url.required'=>'品牌网址必填',
           ]);
        if ($validator->fails()) { 
            return redirect('brand/create') 
            ->withErrors($validator) 
            ->withInput();
         }
       //判断有无文件上传
       if($request->hasFile('brand_logo')){
        //文件上传
        $brand_logo=uploads('brand_logo');
        //var_dump($img);
     }
     //DB操作
     //$res=DB::table('brand')->insert($brand);
     //orm操作
     $brandModel=new Brand;
     $brandModel->brand_name=$request->brand_name;
     $brandModel->brand_url=$request->brand_url;
     if(isset($brand_logo)){
        $brandModel->brand_logo=$brand_logo;
     }
     $brandModel->brand_desc=$request->brand_desc;
     $res=$brandModel->save();

        if($res){
         return redirect('brand');
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
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         //$res=DB::table('brand')->where('id',$id)->first();
         $res=Brand::where('id',$id)->first();
          return view('admin/brand/edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBrandPost $request ,$id)
    {
       //echo "123";
        $brand=$request->except('_token');
       //判断有无文件上传
       if($request->hasFile('brand_logo')){
        //文件上传
        $brand_logo=uploads('brand_logo');
        //var_dump($img);
        }

        // $validatedData = $request->validate([
        //      'brand_name' => [
        //         'required',
        //         Rule::unique('brand')->ignore($id,'id')
        //     ],
        //     'brand_url'=>'required', 
        //   ],[
        //      'brand_name.required'=>'品牌名称必填',
        //      'brand_name.unique'=>'品牌网址已存在',
        //      'brand_url.required'=>'品牌网址必填',
        //   ]);


        $validator = Validator::make($request->all(),[
             'brand_name' => [
                'required',
                Rule::unique('brand')->ignore($id,'id')
            ],
            'brand_url'=>'required', 
          ],[
             'brand_name.required'=>'品牌名称必填',
             'brand_name.unique'=>'品牌名称已存在',
             'brand_url.required'=>'品牌网址必填',
          ]);
            if ($validator->fails()) { 
                return redirect('brand/edit/'.$id) 
                ->withErrors($validator) 
                ->withInput();
         }

         $brandModel=Brand::find($id);
         $brandModel->brand_name=$request->brand_name;
         $brandModel->brand_url=$request->brand_url;
         if(isset($brand_logo)){
            $brandModel->brand_logo=$brand_logo;
         }
         $brandModel->brand_desc=$request->brand_desc;
         $res=$brandModel->save();
          if($res){
            return redirect('brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $res=Brand::destroy($id);
        if($res){
            return redirect('brand');
        }
    }
    //验证
    public function checkname(){
        $brand_name=request()->brand_name;
        $count=Brand::where('brand_name',$brand_name)->count();
        return json_encode(['code'=>'00000','count'=>$count]);
    }
     public function del(){
       $id=request()->id;
          
       $where=[
                ['id','in',$id],
         ];
        $res=Brand::destroy();
         if($res){
            return redirect('brand');
        }
            // $res=$cart_model->where($where)->update(['is_del'=>2]);
            // if($res){
            //     successly('');
            // }else{
            //     fail('删除失败');
            // }
    }
}
