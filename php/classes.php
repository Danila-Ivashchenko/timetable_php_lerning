<?php


	class field{
		public function __construct(string $type, mysqli $conn, $filename){
			$connection = $conn;
			switch ($type){
				case 'teachers':
					$this->create_teachers($conn, $filename);
					break;
				case 'lessons':
					$this->create_lessons($conn, $filename);
					break;
				case 'timetable':
					$this->create_current_timetable($conn, $filename);
					break;
				default:
					break;
			}
		}

		private function create_teachers(mysqli $conn, $filename){
			$query = self::$teachers_q;
			$info = $conn->query($query);
	
			$teachers = array();
			echo "<br><div class='teacher_field'>";
			for ($i = 0; $i < $info->num_rows; $i++){
				$temp = $info->fetch_array(MYSQLI_ASSOC);
				array_push($teachers, new teacher_card($conn, $temp));
				$teachers[$i]->print_all(get_filename($filename));
			}
			echo '<br></div>';
		}

		private function create_lessons(mysqli $conn, $filename){
			$query = self::$lessons_q;
			$info = $conn->query($query);
	
			$lessons = array();
			echo "<br><div class='lessons_field'>";
			for ($i = 0; $i < $info->num_rows; $i++){
				$temp = $info->fetch_array(MYSQLI_ASSOC);
				array_push($lessons, new lesson_card($conn, $temp));
				$lessons[$i]->print_all(get_filename($filename));
			}
			echo '<br></div>';
		}

		private function create_current_timetable(mysqli $conn, $filename){
			$query = self::$current_timetable__q;
			$info = $conn->query($query);
	
			$timetable = array();
			echo "<br><div class='lessons_field'>";
			for ($i = 0; $i < $info->num_rows; $i++){
				$temp = $info->fetch_array(MYSQLI_ASSOC);
				array_push($timetable, new current_timetable_card($conn, $temp));
				$timetable[$i]->print_all(get_filename($filename));
			}
			echo '<br></div>';
		}

		static $current_timetable__q = 'SELECT current_timetable.id, lessons.title, teachers.sername, teachers.name, teachers.patronymic, current_timetable.classroom, current_timetable.weekday, current_timetable.position FROM current_timetable, lessons, teachers WHERE current_timetable.lesson_id = lessons.id AND current_timetable.teacher_id = teachers.id ORDER BY current_timetable.weekday, current_timetable.position;';
		static $teachers_q = 'SELECT * FROM teachers';
		static $lessons_q = 'SELECT * FROM lessons';
	}

	class lesson_card{
		private ?string $title;
		private int $id;

		public function __construct(mysqli $conn, array $str){
			$this->id = $str['id'];
			$this->title = $str['title'];
		}

		public function print_all($filename){
			echo <<<_END
			<div class='lesson_card'>
				<span class='id'>$this->id</span>
				<span>$this->title</span>
			</div>

			<form action='$filename' method='post'>
				<input type='hidden' name='id_to_delete' value='$this->id'>
				<input type='hidden' name='type' value='lesson'>
				<input type='hidden' name='delete_record' value='yes'>
				<input type='submit' value='удалить'>
			</form>
			_END;
		}

	}

	class teacher_card{
		private ?string $sername, $name, $patronymic;
		private int $id;
		public function __construct(mysqli $conn, array $str){
			$this->id = $str['id'];
			$this->sername = $str['sername'];
			$this->name = $str['name'];
			$this->patronymic = $str['patronymic'];
		}

		public function print_all($filename){
			echo <<<_END
			<div class='teacher_card'>
				<span class='id'>$this->id</span>
				<span>$this->sername $this->name $this->patronymic</span>
			</div>

			<form action='$filename' method='post'>
				<input type='hidden' name='id_to_delete' value='$this->id'>
				<input type='hidden' name='type' value='teacher'>
				<input type='hidden' name='delete_record' value='yes'>
				<input type='submit' value='удалить'>
			</form>
			_END;
		}

		public function get_id(){
			return $this->id;
		}
	}

	class current_timetable_card{
		private ?string $title, $full_name;
		private int $id;
		
		public function __construct(mysqli $conn, array $str){
			$this->id = $str['id'];
			$this->title = $str['title'];
			$this->full_name = $str['sername'] . ' ' . $str['name']. ' ' . $str['patronymic'];
		}

		public function print_all($filename){
			echo <<<_END
			<div class='teacher_card'>
				<span class='id'>$this->id</span>
				<span>$this->title</span>
				<span>$this->full_name</span>
				<span>$this->full_name</span>
			</div>

			<form action='$filename' method='post'>
				<input type='hidden' name='id_to_delete' value='$this->id'>
				<input type='hidden' name='delete_record' value='yes'>
				<input type='submit' value='удалить'>
			</form>
			_END;
		}

		public function get_id(){
			return $this->id;
		}
	}
?>