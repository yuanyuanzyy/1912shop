<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="{{url('adddo')}}" method="post">
		@csrf
		<input type="text" name="text">
		<button>aa</button>
	</form>
</body>
</html>