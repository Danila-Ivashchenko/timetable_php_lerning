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
		$lg_user = defuse($conn, $_POST['login']);
		$query = "SELECT * FROM users WHERE username = '$lg_user'";
		$result = $conn->query($query);

		if ($result->num_rows){
			echo "Данный пользователь уже сучществует";
		} else {
			if ($_POST['password'] == $_POST['password_check']){
				$fn_user = defuse($conn, $_POST['firstname']);
				$sn_user = defuse($conn, $_POST['surname']);
				$pw_user = password_hash(defuse($conn, $_POST['password']), PASSWORD_DEFAULT);
				add_user($conn, $lg_user, $fn_user, $sn_user, $pw_user);
				// $query = "INSERT INTO users VALUES (NULL, '$fn_user', '$sn_user', '$lg_user', '$pw_user')";
				// $result = $conn->query($query);
				// if ($result) echo 'Пользователь создан';
				// else echo 'Ошибка ' . $query;
			}
			else {
				echo 'Пароли не совпадают';
			}
		}
	}
		
	?>
	<form action='setusers.php' method='post'>
		<label for="fn">Имя</label>
		<input type='text' name='firstname' id ='fn' autocomplete="new-password">
		<label for="sn">Фамилия</label>
		<input type='text' name='surname' id ='sn' autocomplete="new-password">
		<label for="lg">Логин</label>
		<input type='text' name='login' id ='lg' autocomplete="new-password">
		<label for="pw">Пароль</label>
		<input type='password' name='password' id ='pw' autocomplete="new-password">
		<label for="pw_c">Пароль ещё раз</label>
		<input type='password' name='password_check' id ='pw_c' autocomplete="new-password">
		<input type='submit' value='Отправить'>
	</form>
</body>
</html>