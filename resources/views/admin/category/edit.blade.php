<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>分类表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h3 color=rad>分类添加
	<a href="{{url('brand')}}">
	
			<button type="button" class="btn btn-info">分类列表</button>
		
	</a>
</h3></center>
<form class="form-horizontal" role="form" action="{{url('category/update/'.$cate->cate_id)}}" method="post" enctype="multipart/form-data">
	@csrf
	
	<div class="form-group">

		<label for="firstname" class="col-sm-2 control-label">分类名字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="cate_name" id="firstname" 
				   placeholder="分类名字" value="{{$cate->cate_name}}">
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">顶级分类</label>
		<div class="col-sm-10">
			<select name="pid" id="">
				<option value="">顶级分类</option>
					@foreach($cateinfo as $v)
					<option value='{{$cate->cate_id}}'>{{$cate->cate_name}}</option>
					@endforeach
						
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="cate_show" value="1" {{$cate->cate_show==1?"checked":""}}>是
			<input type="radio"  name="cate_show" value="2" {{$cate->cate_show==2?"checked":""}}>否
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示到导航栏</label>
		<div class="col-sm-10">
			<input type="radio" name="cate_show_nav" value="1" {{$cate->cate_show_nav==1?"checked":""}}>是
			<input type="radio" name="cate_show_nav" value="2" {{$cate->cate_show_nav==2?"checked":""}}>否
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