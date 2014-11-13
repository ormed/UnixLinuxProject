<?php
header('Content-type: application/json');
include_once('../parts/help_functions.php');

$user = $_POST['user-name'];
$full_name = $_POST['full-name'];
$password = $_POST['pwd'];
$repassword = $_POST['repwd'];
$shell = $_POST['login-shell'];
$page = $_POST['page'];


$error = '';
$success = '';


switch ($page) {
	case 'add_user':
    	$success = shell_exec('sudo useradd ' . $user);
		$success .= shell_exec('echo ' . $password . ' | sudo passwd ' . $user . ' --stdin');
    	break;
	case 'remove_user':
    	$success = shell_exec('cut -d : -f 1 /etc/passwd');
    	break;
}

$result = array(
	'error'		=> $error,
	'success'	=> $success
);

echo (json_encode($result));