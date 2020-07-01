<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title></title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h3 color=rad>品牌编辑
	<a href="{{url('brand')}}">
	
			<button type="button" class="btn btn-info">列表</button>
		
	</a>
</h3></center>
<form class="form-horizontal" role="form" action="{{url('brand/update/'.$res->id)}}" method="post" enctype="multipart/form-data">
	
	@csrf

	<div class="form-group">

		<input type="hidden" name="id" value="{{$res->id}}">

		<label for="firstname" class="col-sm-2 control-label">品牌名字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_name" id="firstname" 
				   placeholder="请输入品牌名字" value="{{$res->brand_name}}">
				    <b style="color:red">{{ $errors->first('brand_name') }}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_url"  id="lastname" 
				   placeholder="请输入品牌网址"  value="{{$res->brand_url}}">
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌logo</label>
		<div class="col-sm-6">
			<input type="file" class="form-control" name="brand_logo"  id="lastname" 
				   placeholder="请输入品牌logo" value="{{$res->brand_logo}}">
			
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌介绍</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="brand_desc"  id="lastname" 
				   placeholder="请输入品牌介绍">{{$res->brand_desc}}</textarea>
		</div>
	</div>
	

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">编辑</button>
		</div>
	</div>
</form>

</body>
</html>