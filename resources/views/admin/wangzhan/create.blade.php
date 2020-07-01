<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h3 color=rad>商品添加
	<a href="{{url('wangzhan')}}">
	
			<button type="button" class="btn btn-info">商品列表</button>
		
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
<form class="form-horizontal" role="form" action="{{url('wangzhan/store')}}" method="post" enctype="multipart/form-data">
	@csrf

	<div class="form-group">

		<label for="firstname" class="col-sm-2 control-label">网站名字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="wname" id="firstname" 
				   placeholder="请输入网站名字">
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="wurl"  id="lastname" 
				   placeholder="请输入网站网址">
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网址类型</label>
		<div class="col-sm-5">
			<input type="radio"  name="wlei" value="1">LoGO链接
			<input type="radio"  name="wlei" value="2">文字链接
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">图片logo</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="wimg"  id="lastname">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站联系人</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="wuname"  id="lastname" 
				   >
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站介绍</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="wdesc"  id="lastname" 
				   >
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div >
			<input type="radio" name="is_show" value="1">是
			<input type="radio" name="is_show" value="2">否
		</div>
	</div>

	

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">提交</button>
		</div>
	</div>
</form>

</body>
</html>