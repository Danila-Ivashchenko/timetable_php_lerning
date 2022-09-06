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

	if (isset($_POST['title'])){
		if ($_POST['title'] != ''){
			$title = defuse($conn, $_POST['title']);
			$query = "INSERT INTO lessons VALUES (NULL, '$title');";
			$result = $conn->query($query);
			if (!$result) {echo 'Ошибка ввода';}
			else echo 'Успешно';
		} else {
			echo 'Введите данные';
		}
	}

	if (isset($_POST['id_to_delete']) && isset($_POST['delete_record']) && isset($_POST['type'])){
		$type = $_POST['type'];
		$id = $_POST['id_to_delete'];
		switch ($type){
			case 'teacher':
				$query = "DELETE FROM teachers WHERE id = '$id'";
				break;
			case 'lesson':
				$query = "DELETE FROM lessons WHERE id = '$id'";
				break;
			case 'current_timetable':
				$query = "DELETE FROM lesson WHERE id = '$id'";
				break;
			default:
				break;
		}
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
	$teacher_field = new field('teachers', $conn, __FILE__);
	echo '<br><br>';
	?>
	<form action='teachers.php' method='post'>
		<input type='text' name='title'>
		<input type='submit' value='Отправить'>
	</form>
	<?php
	$lessons_field = new field('lessons', $conn, __FILE__);
	?>
	<?php
	$teachers = $conn->query('SELECT * FROM teachers');
	$lessons = $conn->query('SELECT * FROM lessons');
	echo "<form action='teachers.php' method='post'>";
			echo "<select name='lesson_id'>";
			for ($i = 0; $i < $lessons->num_rows; $i++){
				$temp = $lessons->fetch_array(MYSQLI_ASSOC);
				$id = $temp['id'];
				$title = $temp['title'];
				echo "<option value=$id>$title</option>";
			}
			echo "</select>";
			echo "<select name='teacher_id'>";
			for ($i = 0; $i < $teachers->num_rows; $i++){
				$temp = $teachers->fetch_array(MYSQLI_ASSOC);
				$id = $temp['id'];
				$name = $temp['sername'] . ' ' . $temp['name'] . ' ' . $temp['patronymic'];
				echo "<option value=$id>$name</option>";
			}
			echo "</select>";
			echo <<<_END
			<input type='text' name='classroom'>
			<input type='text' name='weekday'>
			<input type='text' name='position'>
			<input type='submit' value='Отправить'>
		</form>
		_END;
	?>
	<?php
	$lessons_field = new field('timetable', $conn, __FILE__);
	?>

</body>
</html>