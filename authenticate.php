<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php
		require_once 'php/login.php';
		require_once 'php/functions.php';

		$conn = new mysqli($hn, $un, $ps, $db);

		if (isset($_POST['firstname']) &&
			isset($_POST['surname']) &&
			isset($_POST['login']) &&
			isset($_POST['password']) &&
			isset($_POST['password_check'])
		){
			
		}
	?>
</body>
</html>