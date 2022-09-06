<?php
	class teacher_card{
		private ?string $sername, $name, $patronymic;
		private int $id;
		public function __construct(mysqli $conn, array $str){
			$this->id = $str['id'];
			$this->sername = $str['sername'];
			$this->name = $str['name'];
			$this->patronymic = $str['patronymic'];
		}

		public function print_all(){
			echo <<<_END
			<div class='teacher_card'>
				<span class='id'>$this->id</span>
				<span>$this->sername, $this->name, $this->patronymic</span>
			</div>
			_END;
		}

		public function get_id(){
			return $this->id;
		}
	}
?>