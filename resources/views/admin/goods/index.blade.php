<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h3 color=rad>商品列表
	<a href="{{url('/goods/create')}}">
	
			<button type="button" class="btn btn-info">添加</button>
		
	</a>
</h3></center>
<form action="">
	<input type="text" name="goods_name">
	<input type="submit" value="搜索">
</form>
<table class="table table-bordered" border="1">
	
	<thead>
		<tr>
			<td><input type="checkbox" id="allbox"></td>
			<th>id</th>
			<th>商品名称</th>
			<th>商品价格</th>
			<th>商品介绍</th>
			<th>商品数量</th>
			<th>商品图片</th>
			<th>是否最新</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($goods as $v)
		<tr  id="{{$v->goods_id}}">

			<td><input type="checkbox" class="box"></td>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_desc}}</td>
			<td>{{$v->goods_num}}</td>
			<td><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="70"></td>
			<td>{{$v->is_new}}</td>
			<td>
				<a href="{{url('goods/edit/'.$v->goods_id)}}">
					<button type="button" class="btn btn-primary">编辑</button>
				</a>
				<a href="{{url('goods/destroy/'.$v->goods_id)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
			</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="8">{{$goods->appends(['goods_name'=>$goods_name])->links()}}</td>
		
		</tr>
	</tbody>
</table>

</body>
</html>
<script>
$(function(){
	 //点击全选
         $(document).on("click","#allbox",function(){
              var _this=$(this);
             var status=$("#allbox").prop('checked');
             if(status==true){
               
                 $(".box").prop('checked',true);
             }else{
                
                   $(".box").prop('checked',false);
             }
         })
     })
</script>