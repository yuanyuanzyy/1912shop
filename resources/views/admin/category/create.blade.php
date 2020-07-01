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
<form class="form-horizontal" role="form" action="{{url('category/store')}}" method="post" enctype="multipart/form-data">
	@csrf
	
	<div class="form-group">

		<label for="firstname" class="col-sm-2 control-label">分类名字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="cate_name" id="firstname" 
				   placeholder="分类名字">
				    <b style="color:red">{{ $errors->first('cate_name') }}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">顶级分类</label>
		<div class="col-sm-10">
			<select name="pid" id="">
				<option value="">顶级分类</option>
					@foreach($cate as $v)
					<option value='{{$v->cate_id}}'>
						{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
					@endforeach			
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="cate_show" value="1">是
			<input type="radio"  name="cate_show" value="2">否
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示到导航栏</label>
		<div class="col-sm-10">
			<input type="radio" name="cate_show_nav" value="1">是
			<input type="radio" name="cate_show_nav" value="2">否
		</div>
	</div>
	

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>
<script>
	$('input[name=cate_name]').blur(function(){
		$(this).next().empty;
		var cate_name=$(this).val();
		var obj=$(this);
	    //console.log(obj);
	    if(cate_name==''){
	    	obj.next().text('分类称不能为空');
	    	return;
	    }
	    $.get('/category/checkname',{cate_name:cate_name},function(res){
	    	if(res.count){
	    		obj.next().text('分类名称已存在');
	    	}
	    },'json');
	})
	
</script>