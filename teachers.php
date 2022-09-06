<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>teachers</title>
</head>
<body>
	<?php
	require_once 'php/login.php';
	require_once 'php/functions.php';
	require_once 'php/classes.php';
	$conn = new mysqli($hn, $un, $ps, $db);
	if (!$conn) die('ERROR');

	if (isset($_POST['sername']) && isset($_POST['name']) && isset($_POST['patronymic'])){
		if ($_POST['sername'] != '' && $_POST['name'] != '' && $_POST['patronymic'] != ''){
			$sername = defuse($conn, $_POST['sername']);
			$name = defuse($conn, $_POST['name']);
			$patronymic = defuse($conn, $_POST['patronymic']);
			$query = "INSERT INTO teachers VALUES (NULL, '$sername', '$name', '$patronymic');";
			$result = $conn->query($query);
			if (!$result) {echo 'Ошибка ввода';}
			else echo 'Успешно';
		} else {
			echo 'Введите данные';
		}
	}
	if (isset($_POST['id_to_delete']) && isset($_POST['delete_record'])){
		$id = $_POST['id_to_delete'];
		$query = "DELETE FROM teachers WHERE id = '$id'";
		$result = $conn->query($query);
		if (!$result){
			echo 'Ошибка при удалении';
		} else {
			echo 'Успешно удалено';
		}
	}
	

	?>
	<form action='teachers.php' method='post'>
		<input type='text' name='sername'>
		<input type='text' name='name'>
		<input type='text' name='patronymic'>
		<input type='submit' value='Отправить'>
	</form>

	<?php
	$query = ('SELECT * FROM teachers');
	$info = $conn->query($query);
	$teachers = array();
	for ($i = 0; $i < $info->num_rows; $i++){
		$temp = $info->fetch_array(MYSQLI_ASSOC);
		array_push($teachers, new teacher_card($conn, $temp));
		$teachers[$i]->print_all();
		$id = $teachers[$i]->get_id();

		echo <<<_END
		<form action='teachers.php' method='post'>
			<input type='hidden' name='id_to_delete' value='$id'>
			<input type='hidden' name='delete_record' value='yes'>
			<input type='submit' value='удалить'>
		</form>
		_END;
	}
	?>

</body>
</html>