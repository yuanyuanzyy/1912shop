<?php 

	function uploads($filename){

        $file=request()->file($filename);

        if($file->isValid()){
            
           $path = $file->store('uploads');
           return $path;
        }
        exit('文件上传过程中出错');
    }
   
    function cateTree($data,$pid=0,$level=1){
        if(!$data)return ;
        static $newArray=[];
        foreach ($data as $v) {
            if($v->pid==$pid){
                $v->level=$level;
                $newArray[]=$v;
                cateTree($data,$v->cate_id,$level+1);
            }
        }
         return $newArray;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 ?>