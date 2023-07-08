<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<form action="/admin/sender" method="POST">
		{{ csrf_field() }}
		<input type="text" name="text">
		<input type="submit" name="" value="Send">
	</form>
</body>
</html>