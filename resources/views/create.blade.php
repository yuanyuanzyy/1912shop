<form action="{{url('create')}}" method="post">
	@csrf
	<input type="text" name="bname">
	<input type="submit" value="提交">
</form>