<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h3><center>文章表单</center></h3>
@if ($errors->any()) 
<div class="alert alert-danger"> 
	<ul>@foreach ($errors->all() as $error)
	 <li>{{ $error }}</li> 
@endforeach
</ul> 
</div>
 @endif
<form class="form-horizontal" role="form" action="{{'store'}}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章名字</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="bname"
				   placeholder="请输入文章名字">
				   <b stype="color:red">{{$errors->first('bname')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-5">
			<select name="b_id" id="">
				<option value="">请选择</option>
				@foreach($res as $v)
				<option value="{{$v->t_id}}">{{$v->t_name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-5">
			<input type="radio"  id="lastname" name="is_zhong" value="1" checked>普通
			<input type="radio"  id="lastname" name="is_zhong" value="2">重要
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-5">
			<input type="radio"  id="lastname" name="is_show" value="1" checked>是
			<input type="radio"  id="lastname" name="is_show" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="lastname" name="author"
				   placeholder="请输入作者姓名">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">作者邮箱</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="lastname" name="bemail"
				   placeholder="请输入作者邮箱">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="lastname" name="keyword"
				   placeholder="请输入关键字">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="lastname" name="bdesc"
				   placeholder="请输入网页描述">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-5">
			<input type="file" class="form-control" id="lastname" name="bimg">
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">登录</button>
		</div>
	</div>
</form>

</body>
</html>
<script>
	 $('input[name="bname"]').blur(function(){
	 	$(this).next().empty();
	 	//获取值
	 	var bname=$(this).val();
	 	var obj=$(this);
	 	var reg=/^[\u4e00-\u9fa5\w]{2,15}$/;
	 	if(!reg.test(bname)){
	 		$(this).next().text('文章名称需要是中文、字母、数字、下划线长度2-15位组成');
	 		return;
	 	}
	 	$.get('/book/checkname',{bname:bname},function(res){
	 		if(res.count){
	 			obj.next().text('品牌名称已存在');
	 		}
	 	},'json');
	 })
	$('button').click(function(){
		var bname=$('input[name="bname"]').val();
		var obj=$('input[name="bname"]');
		var reg=/^[\u4e00-\u9fa5\w]{2,15}$/;
		if(!reg.test(bname)){
			obj.next().text('文章名称需要是中文、字母、数字、下划线长度2-15位组成');
			return;
		}
		//唯一性验证
		// $.get('/book/checkname',{bname:bname},function(res){
		// 	if(res.count){
		// 		obj.next().text('品牌名称已存在');
		// 	}
		// },'json');
		var flag=false;
		$.ajax({
			type:"get",
			url:'/book/checkname',
			data:{bname:bname},
			dataType:'json',
			async:false,
			success:function(res){
				if(res.count){
					obj.next().text('品牌名称已存在');
					flag=true;
				}
			}
		});
		if(flag){
			return;
		}
		//文章作者不能为空
		var author=$('input[name="author"]').val();
		if(!reg.test(author)){
			obj.next().text('文章作者需要是中文、字母、数字、下划线长度2-15位组成');
			return;
		}
		$('form').submit();
	})
</script>