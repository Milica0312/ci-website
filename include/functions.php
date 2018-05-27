<?php
include 'db.php';


function proveriURL($url) {
    $url = preg_replace("/(\bselect\b|\binsert\b|\bdelete\b|\bdrop\b|\bupdate\b|\bshow tables\b|\bunion\b|--|http|script|iframe)/u", "", $url);
    $url = trim($url);
    $url = strip_tags($url);
    return $url;
}

function allowed_post_params($allowed_params=[]) {
	$allowed_array = [];
	foreach($allowed_params as $param) {
		if(isset($_POST[$param])) {
			$allowed_array[$param] = $_POST[$param];
		} else {
			$allowed_array[$param] = NULL;
		}
	}
	return $allowed_array;
}

function has_length($value, $options=[]) {
	if(isset($options['max']) && (strlen($value) > (int)$options['max'])) {
		return false;
	}
	if(isset($options['min']) && (strlen($value) < (int)$options['min'])) {
		return false;
	}
	if(isset($options['exact']) && (strlen($value) != (int)$options['exact'])) {
		return false;
	}
	return true;
}

function limitdate(){
	
				
				
				

}