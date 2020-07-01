<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
<center><h3 color=rad>管理员列表
	<a href="{{url('/book/create')}}">
	
			<button type="button" class="btn btn-info">添加</button>
		
	</a>
</h3></center>
<form action="">
	<input type="text" name="bname" value="{{$bname}}">
	<input type="submit" value="搜索">
</form>

<table class="table table-bordered">
	
	<thead>
		<tr>
			<th>id</th>
			<th>文章名称</th>
			<th>文章分类</th>
			<th>文章重要性</th>
			<th>是否显示</th>
			<th>文章作者</th>
			<th>作者邮箱</th>
			<th>关键字</th>
			<th>文章描述</th>
			<th>时间</th>
			<th>上传文件</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($book as $v)
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->bname}}</td>	
			<td>{{$v->t_name}}</td>
			<td>{{$v->is_zhong==1?"普通":"重要"}}</td>	
			<td>{{$v->is_show==1?"√":"×"}}</td>
			<td>{{$v->author}}</td>	
			<td>{{$v->bemail}}</td>
			<td>{{$v->keyword}}</td>
			<td>{{$v->bdesc}}</td>
			<td>{{date('Y-m-d H:i:s',$v->btime)}}</td>
			<td><img src="{{env('UPLOADS_URL')}}{{$v->bimg}}" width="70"></td>
			<td>
				<a href="{{url('book/edit/'.$v->id)}}">
					<button type="button" class="btn btn-primary">编辑</button>
				</a>
				
					<button type="button" class="btn btn-danger" id="{{$v->id}}">删除</button>
				
			</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="12">{{$book->appends(['bname'=>$bname])->links()}}</td>
		</tr>
		
	</tbody>
</table>

</body>
</html>
<script>
	$('.btn-danger').click(function(){
		//alert(123);
		 var _id=$(this).attr('id');
		 var obj=$(this);
		 //console.log(obj);
		 // $.get('/book/destroy/'+_id,function(res){
		 // 	if(res.code=='00000'){
		 // 		location.reload();
		 // 	}
		 // },'json')
		 $.ajaxSetup({ headers: {
		  'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
		 } });
		 $.post('/book/destroy/'+_id,function(res){
		  	if(res.code=='00000'){
		  		obj.parent().parent().hide();
		  	}
		  },'json');
	});
</script>