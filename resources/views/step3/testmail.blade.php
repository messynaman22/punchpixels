<!DOCTYPE html>
<html>
<head>
	<title>Test mail</title>
</head>
<body>
   {!!Form::text('mpaddress', isset($data["test"])?$data["test"]:'value', ['id'=>'mpaddress', 'class'=>'form-control req'])!!}
</body>
</html>