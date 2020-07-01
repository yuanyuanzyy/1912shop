<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>分类列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h3 color=rad>分类列表
	<a href="{{url('/category/create')}}">
	
			<button type="button" class="btn btn-info">添加</button>
		
	</a>
</h3></center>
<table class="table table-bordered">
	
	<thead>
		<tr>
			<th><input type="checkbox" id="allbox"></th>
			<th>id</th>
			<th>分类名称</th>
			<th>是否显示</th>
			<th>是否显示到导航栏</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($cate as $v)
		<tr  id="{{$v->cate_id}}">
			<td><input type="checkbox" class="box"></td>
			<td>{{$v->cate_id}}</td>
			<td>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</td>
			<td>{{$v->cate_show==1?"√":"×"}}</td>
			<td>{{$v->cate_show_nav==1?"√":"×"}}</td>
			<td>
				<a href="{{url('category/edit/'.$v->cate_id)}}">
					<button type="button" class="btn btn-primary">编辑</button>
				</a>
				<a href="{{url('category/destroy/'.$v->cate_id)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

</body>
</html>
<script>
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
</script>