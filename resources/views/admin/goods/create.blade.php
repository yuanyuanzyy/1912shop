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
	<a href="{{url('goods')}}">
	
			<button type="button" class="btn btn-info">商品列表</button>
		
	</a>
</h3></center>
<form class="form-horizontal" role="form" action="{{url('goods/store')}}" method="post" enctype="multipart/form-data">
	@csrf

	<div class="form-group">

		<label for="firstname" class="col-sm-2 control-label">商品名字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_name" id="firstname" 
				   placeholder="请输入商品名字">
				   <b style="color:red">{{ $errors->first('goods_name') }}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_price"  id="lastname" 
				   placeholder="请输入商品价格">
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品介绍</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_desc"  id="lastname" 
				   placeholder="请输入商品介绍o">
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品数量</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_num"  id="lastname" 
				   placeholder="请输入商品数量">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="goods_img"  id="lastname" 
				   >
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否最新</label>
		<div class="col-sm-10">
			<input type="radio" name="is_new" value="1">是
			<input type="radio" name="is_new" value="2">否
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
	$('input[name=goods_name]').blur(function(){
		$(this).next().empty;
		var goods_name=$(this).val();
		var obj=$(this);
	    //console.log(obj);
	    if(goods_name==''){
	    	obj.next().text('商品称不能为空');
	    	return;
	    }
	    $.get('/goods/checkname',{goods_name:goods_name},function(res){
	    	if(res.count){
	    		obj.next().text('商品名称已存在');
	    	}
	    },'json');
	})
	
</script>