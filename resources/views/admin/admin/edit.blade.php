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
<form class="form-horizontal" role="form" action="{{url('admin/update/'.$admin->admin_id)}}" method="post" enctype="multipart/form-data">
	@csrf
	//{{csrf_field()}}
	<div class="form-group">

		<label for="firstname" class="col-sm-2 control-label">管理员名字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_name" id="firstname" 
				   placeholder="请输入管理员名字" value="{{$admin->admin_name}}">
				 <b style="color:red">{{ $errors->first('admin_name') }}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" name="admin_pwd"  id="lastname" 
				   placeholder="请输入管理员密码" value="{{$admin->admin_name}}">
				   <b style="color:red">{{ $errors->first('admin_pwd') }}</b>
				   
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员头像</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="my_img"  id="lastname" 
				  >
		</div>
	</div>

	<div class="form-group">

		<label for="firstname" class="col-sm-2 control-label">管理员邮箱</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="eamil" id="firstname" 
				   placeholder="请输入管理员邮箱" value="{{$admin->eamil}}">
				 <b style="color:red">{{ $errors->first('eamil') }}</b>
		</div>
	</div>

	<div class="form-group">

		<label for="firstname" class="col-sm-2 control-label">管理员手机</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="tel" id="firstname" 
				   placeholder="请输入管理员名字手机" value="{{$admin->tel}}">
				 <b style="color:red">{{ $errors->first('tel') }}</b>
		</div>
	</div>


	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>