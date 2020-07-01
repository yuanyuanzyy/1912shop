<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>品牌表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h3 color=rad>品牌添加
	<a href="{{url('brand')}}">
	
			<button type="button" class="btn btn-info">列表</button>
		
	</a>
</h3></center>
<form class="form-horizontal" role="form" action="{{url('student/store')}}" method="post">

	{{csrf_field()}}
	<div class="form-group">

		<label for="firstname" class="col-sm-2 control-label">学生名字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="sname" id="firstname" 
				   placeholder="学生名字">
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生性别</label>
		<div class="col-sm-10">
			<input type="radio"  name="sex" value="1">男
			<input type="radio"  name="sex" value="2">女
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生年龄</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="age"  id="lastname" 
				   placeholder="请输入学生年龄">
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">班级</label>
		<div class="col-sm-10">
			<select name="class" id="">
				<option value="">请选择</option>
				<option value="1">2015</option>
				<option value="2">2016</option>
				<option value="3">2017</option>
				<option value="4">2018</option>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">头像</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="head"  id="lastname" 
				   placeholder="请输入头像">
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">登录</button>
		</div>
	</div>
</form>

</body>
</html>