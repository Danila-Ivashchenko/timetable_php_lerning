<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="css/style_users.css?t=<?php echo(microtime(true).rand()); ?>" type="text/css" />
</head>
<body>
	<div class="wrapper_form">
		<div class="inner_form">
			<h2>Регистрационная форма</h2>
			<form action="#" method="post" onSubmit="return validate(this)">
				<div class="line">
					<label for="fn">Имя</label>
					<input type="text" name="firstname" id="fn">
				</div>
				<div class="line">
					<label for="sn">Фамилия</label>
					<input type="text" name="sername" id="sn">
				</div>
				<div class="line">
					<label for="lg">Логин</label>
					<input type="text" name="login" id="lg">
				</div>
				<div class="line">
					<label for="pw">Пароль</label>
					<input type="text" name="password" id="pw">
				</div>
				<div class="line">
					<label for="pw_c">Пароль ещё раз</label>
					<input type="text" name="password_check" id="pw_c">
				</div>
				<input type="submit" value="Отправить">
			</form>
		</div>
	</div>

	<script src="js/function_users.js"></script>
</body>
</html>