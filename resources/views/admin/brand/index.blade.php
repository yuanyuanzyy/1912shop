<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>品牌列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h3 color=rad>品牌列表
	<a href="{{url('/brand/create')}}">
	
			<button type="button" class="btn btn-info">添加</button>
		
	</a>
</h3></center>
<form action="">
	<input type="text" name="brand_name">
	<input type="submit" value="搜索">
</form>

<table class="table table-bordered">
	
	<thead>
		<tr >
			<th><input type="checkbox"  id="allbox">全选</th>
			<th>id</th>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌logo</th>
			<th>品牌介绍</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($brand as $v)
		<tr id="{{$v->id}}">
			<td><input type="checkbox" class="box"></td>
			<td>{{$v->id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_url}}</td>
			<td><img src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}" width="70"></td>
			<td>{{$v->brand_desc}}</td>
			<td>
				<a href="{{url('brand/edit/'.$v->id)}}">
					<button type="button" class="btn btn-primary">编辑</button>
				</a>
				<a href="{{url('brand/destroy/'.$v->id)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
				<a href="#" id="delmany">清空</a>
			</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="7">{{$brand->appends(['brand_name'=>$brand_name])->links()}}</td>
		</tr>
	</tbody>
	
		<td colspan="7"><a href="#" id="delmany">清空</a></td>
	
	
</table>

</body>
</html>

<script>
$(function(){
	  //点击全选
         $(document).on("click","#allbox",function(){
              var _this=$(this);
             var status=$("#allbox").prop('checked');
             if(status==true){
               
                 $(".box").prop('checked',true);
             }else{
                
                   $(".box").prop('checked',false);
             }
            //console.log(123);
         })

          //批量删除
           $(document).on('click','#delmany',function(){
                var _box=$(".box:checked");
                if(_box.length==0){
                    alert("请至少选择一件商品进行删除");
                    return false;
                }
                //循环得到每一个复选框所属于的商品id
                var id='';
                _box.each(function(index){
                    id +=$(this).parents("tr").attr('id')+',';
                })
             //     id=id.substr(0,id.length-1);
             //     $.ajax({
	            //      url:"{:url('brand/del')}",
	            //      type:"get",
	            //      data:{id:id},
	            //      dataType:'json',
	            //      success:function(res){
             //         console.log(res);
             //     }
             // })
			 $.get('/brand/del',{id:id},function(res){
	    		console.log(res);
	         });
           })

       })
</script>