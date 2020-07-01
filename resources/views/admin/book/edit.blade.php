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

<form class="form-horizontal" role="form" action="{{url('book/update/'.$book->id)}}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章名字</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="bname"
				   placeholder="请输入文章名字" value="{{$book->bname}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-5">
			<select name="b_id" id="">
				<option value="">请选择</option>
				@foreach($res as $v)
				<option {{$book->b_id==$v->t_id?"selected":""}} value="{{$v->t_id}}">{{$v->t_name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-5">
			<input type="radio"  id="lastname" name="is_zhong" value="1" {{$book->is_zhong==1?"checked":""}}>普通
			<input type="radio"  id="lastname" name="is_zhong" value="2" {{$book->is_zhong==2?"checked":""}}>重要
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-5">
			<input type="radio"  id="lastname" name="is_show" value="1" {{$book->is_show==1?"checked":""}}>是
			<input type="radio"  id="lastname" name="is_show" value="2" {{$book->is_show==2?"checked":""}}>否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="lastname" name="author"
				   placeholder="请输入作者姓名" value="{{$book->author}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">作者邮箱</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="lastname" name="bemail"
				   placeholder="请输入作者邮箱" value="{{$book->bemail}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="lastname" name="keyword"
				   placeholder="请输入关键字" value="{{$book->keyword}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="lastname" name="bdesc"
				   placeholder="请输入网页描述" value="{{$book->bdesc}}">
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
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>