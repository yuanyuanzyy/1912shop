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
<form class="form-horizontal" role="form" action="{{url('brand/store')}}" method="post" enctype="multipart/form-data">
	@csrf
	//{{csrf_field()}}
	<div class="form-group">

		<label for="firstname" class="col-sm-2 control-label">品牌名字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_name" id="firstname" 
				   placeholder="请输入品牌名字">
				   <b style="color:red">{{ $errors->first('brand_name') }}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_url"  id="lastname" 
				   placeholder="请输入品牌网址">
				   <b style="color:red">{{ $errors->first('brand_name') }}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌logo</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="brand_logo"  id="lastname" 
				   placeholder="请输入品牌logo">
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌介绍</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="brand_desc"  id="lastname" 
				   placeholder="请输入品牌介绍"></textarea>
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
<script>
	$('input[name=brand_name]').blur(function(){
		$(this).next().empty;
		var brand_name=$(this).val();
		var obj=$(this);
	    //console.log(obj);
	    if(brand_name==''){
	    	obj.next().text('品牌名称不能为空');
	    	return;
	    }
	    $.get('/brand/checkname',{brand_name:brand_name},function(res){
	    	if(res.count){
	    		obj.next().text('品牌名称已存在');
	    	}
	    },'json');
	})
	
</script>