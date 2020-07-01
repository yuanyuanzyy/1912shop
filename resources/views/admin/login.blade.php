<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h3 color=rad>管理员添加
	<a href="{{url('admin')}}">
	
			<button type="button" class="btn btn-info">列表</button>
		
	</a>
</h3></center>
@if ($errors->any()) 
<div class="alert alert-danger">
 <ul>
 	@foreach ($errors->all() as $error)
  <li>
  	{{ $error }}
  </li> 
  @endforeach
</div>
@endif

@if(session('msg'))
<div class="alert-danger">{{session('msg')}}</div>
@endif

<form class="form-horizontal" role="form" action="{{url('logindo')}}" method="post">
	@csrf
	<div class="form-group">

		<label for="firstname" class="col-sm-2 control-label">用户名</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" name="admin_name" id="firstname" 
				   placeholder="请输入用户名名字">
				 <b style="color:red">{{ $errors->first('admin_name') }}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-6">
			<input type="password" class="form-control" name="admin_pwd"  id="lastname" 
				   placeholder="请输入密码">
				   <b style="color:red">{{ $errors->first('admin_pwd') }}</b>
				   
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">七天免登录</label>
		<div class="col-sm-6">
			<input type="checkbox"  name="rember"  >
				  
				   
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