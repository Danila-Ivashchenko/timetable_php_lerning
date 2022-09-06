<?php
function defuse($conn, $str){
	$new_str = $conn->real_escape_string($str);
	$new_str = strip_tags($new_str);
	$new_str = htmlentities($new_str);
	if (get_magic_quotes_gpc())
		$new_str = stripslashes($new_str);
	return $new_str;
}

function get_filename($file){
	$arr = explode('\\', $file);
	return $arr[count($arr) - 1];
}
?>