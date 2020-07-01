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
<table class="table table-bordered">
	
	<thead>
		<tr>
			<th>id</th>
			<th>学生名称</th>
			<th>学生性别</th>
			<th>学生年龄</th>
			<th>班级</th>
			<th>头像</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($student as $v)
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->sname}}</td>
			<td>{{$v->sex}}</td>
			<td>{{$v->age}}</td>
			<td>{{$v->class}}</td>
			<td>{{$v->head}}</td>
			<td>
				<a href="{{url('student/edit/'.$v->id)}}">
					<button type="button" class="btn btn-primary">编辑</button>
				</a>
				
				<a href="{{url('student/destroy/'.$v->id)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

</body>
</html>