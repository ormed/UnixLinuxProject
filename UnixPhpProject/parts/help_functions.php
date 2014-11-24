<?php

/**
 * function get param and write it to php error log
 * used for debug
 * 
 * @param $var - param to be written in error log 
 * @param $readable - TRUE for readable state .
 */
function debug($var, $readable = FALSE) {
    $dump = $readable ? print_r($var, TRUE) : var_export($var, TRUE);
    error_log(("==============================\n\n" . $dump . "\n"), 0);
}

//method that clean the input from things we dont want 
//return clean data
function cleanInput($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function passwordValidateion($user, $pw, $re_pw) {
	$error = "";
	if($pw != $re_pw) {
			$error .= "It seems like the passwords does not match.";	
	}
	if(strlen ( $pw ) < 6) {
			$error .= "Password must contain 6 or more characters.";
	}
	if(strpos($pw, $user) !== FALSE) {
		$error .= "Passwords can not contain the user name.";
	}
	if(!preg_match('/[A-Za-z]/', $pw)) {
		$error .= "Password must contain letters.";
	}
	if(!preg_match('/[0-9]/', $pw)) {
		$error .= "Password must contain numbers.";
	}
	if(strpos($pw, '!') !== FALSE || strpos($pw, '$') !== FALSE 
	|| strpos($pw, '#') !== FALSE || strpos($pw, '%') !== FALSE
	|| strpos($pw, '"') !== FALSE || strpos($pw, '\'') !== FALSE) {
		$error .= "Passwords can not contain Non-alphanumeric.";
	}
	return $error;
}
