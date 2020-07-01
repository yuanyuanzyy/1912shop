<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h3 color=rad>商品列表
	<a href="{{url('/goods/create')}}">
	
			<button type="button" class="btn btn-info">添加</button>
		
	</a>
</h3></center>
<form action="">
	<input type="text" name="wname">
	<input type="submit" value="搜索">
</form>
<table class="table table-bordered" border="1">
	
	<thead>
		<tr>
			<th>id</th>
			<th>网站名称</th>
			<th>网站网址</td>
			<th>网站类型</th>
			<th>商品图片</th>
			<th>联系人</th>
			<th>介绍</th>
			<th>是否显示</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($res as $v)
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->wname}}</td>
			<td>{{$v->wurl}}</td>
			<td>{{$v->wlei}}</td>
			<td><img src="{{env('UPLOADS_URL')}}{{$v->wimg}}" width="70"></td>
			<td>{{$v->wuname}}</td>
			<td>{{$v->wdesc}}</td>
			<td>{{$v->is_show}}</td>
			<td>
				<a href="{{url('wangzhan/edit/'.$v->id)}}">
					<button type="button" class="btn btn-primary">编辑</button>
				</a>
				<a href="{{url('wangzhan/destroy/'.$v->id)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
			</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="9">{{$res->appends(['wname'=>$wname])->links()}}</td>
		</tr>
	</tbody>
</table>

</body>
</html>