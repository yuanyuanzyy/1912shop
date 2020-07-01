<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;
use App\Type;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bname=request()->bname;
        $where=[];
        if($bname){
            $where[]=['bname','like',"%$bname%"];
        }
        $book=Book::
        leftjoin('type','book.b_id','=','type.t_id')
        ->where($where)
        ->paginate(2);
        return view('admin/book/index',['book'=>$book,'bname'=>$bname]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $res=Type::get();
        return view('admin/book/create',['res'=>$res]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book=request()->except("_token");
        if ($request->hasFile('bimg')) { 
            $bimg=uploads('bimg');
            //dd($bimg);
        }
        $validatedData = $request->validate([ 
            'bname' => 'regex:/^[\u4e00-\u9fa5\w]{2,15}$/u|unique:book',
             'author' => 'required', 
        ],[
            'bname.regex'=>"文章不能为空",
            'bname.unique'=>"文章不名称已存在",
            'author.required'=>"作者不能为空",
        ]);


        $BookModel=new Book;
        $BookModel->bname=$request->bname;
        $BookModel->b_id=$request->b_id;
        $BookModel->is_zhong=$request->is_zhong;
        $BookModel->is_show=$request->is_show;
        $BookModel->author=$request->author;
        $BookModel->bemail=$request->bemail;
        $BookModel->keyword=$request->keyword;
        $BookModel->bdesc=$request->bdesc;
        if(isset($bimg)){
            $BookModel->bimg=$bimg;
        }
        $BookModel->btime=time();
       
        $book=$BookModel->save();
        if($book){
            return redirect('book');
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
        $res=Type::get();
        $book=Book::where('id',$id)->first();
        return view('admin/book/edit',['book'=>$book,'res'=>$res]);
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
        $book=request()->except("_token");
        if ($request->hasFile('bimg')) { 
            $bimg=uploads('bimg');
            //dd($bimg);
        }
        $BookModel=Book::find($id);
        $BookModel->bname=$request->bname;
        $BookModel->b_id=$request->b_id;
        $BookModel->is_zhong=$request->is_zhong;
        $BookModel->is_show=$request->is_show;
        $BookModel->author=$request->author;
        $BookModel->bemail=$request->bemail;
        $BookModel->keyword=$request->keyword;
        $BookModel->bdesc=$request->bdesc;
        if(isset($bimg)){
            $BookModel->bimg=$bimg;
        }
       
        $book=$BookModel->save();
        if($book){
            return redirect('book');
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
        //dd(request()->ajax());
         //$book=Book::destroy($id);
        // if($book){
        //     return redirect('book');
        // }
        //echo $id;
        $res=Book::destroy($id);
        if($res){
            if(request()->ajax()){
               return json_encode(['code'=>'00000','msg'=>'删除成功']);
            }
            return redirect('book');
        }
    }
    public function checkname(){
        $bname=request()->bname;
        $count=Book::where('bname',$bname)->count();
        return json_encode(['code'=>'00000','count'=>$count]);
    }
}
