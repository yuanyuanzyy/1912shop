<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h3 color=rad>管理员列表
	<a href="{{url('/admin/create')}}">
	
			<button type="button" class="btn btn-info">添加</button>
		
	</a>
</h3></center>
<form action="">
	<input type="text" name="admin_name">
	<input type="submit" value="搜索">
</form>

<table class="table table-bordered">
	
	<thead>
		<tr>
			<th><input type="checkbox" id="allbox"></th>
			<th>id</th>
			<th>管理员名称</th>
			<th>管理员邮箱</th>
			<th>管理员手机号</th>
			<th>管理员头像</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($admin as $v)
		<tr  id="{{$v->admin_id}}">
			<td><input type="checkbox" class="box"></td>
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_name}}</td>	
			<td>{{$v->email}}</td>
			<td>{{$v->tel}}</td>	
			<td><img src="{{env('UPLOADS_URL')}}{{$v->my_img}}" width="70"></td>
			<td>
				<a href="{{url('admin/edit/'.$v->admin_id)}}">
					<button type="button" class="btn btn-primary">编辑</button>
				</a>
				<a href="{{url('admin/destroy/'.$v->admin_id)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
			</td>
		</tr>
		@endforeach
		<tr>
			<td>{{$admin->appends(['admin_name'=>$admin_name])->links()}}</td>
		</tr>
		
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