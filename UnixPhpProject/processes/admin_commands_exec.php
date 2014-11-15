<?php
header('Content-type: application/json');
include_once('../parts/help_functions.php');

$page = $_POST['page'];

$error = '';
$success = '';


switch ($page) {
	case 'add_user':
		$user = $_POST['user-name'];
		$full_name = $_POST['full-name'];
		$password = $_POST['pwd'];
		$repassword = $_POST['repwd'];
		$shell = $_POST['login-shell'];

    	$success = shell_exec('sudo useradd ' . $user);
		$success .= shell_exec('echo ' . $password . ' | sudo passwd ' . $user . ' --stdin');
    	break;
	case 'remove_user':
		$rm_user = $_POST['option'];

    	$error = shell_exec('sudo userdel ' . $rm_user);
		$success = $rm_user . ' has been deleted.';
    	break;
	case 'date':
		$hour = isset($_POST['hour']) ? $_POST['hour'] : '';
		$minute = isset($_POST['minute']) ? $_POST['minute'] : '';
		$second = isset($_POST['second']) ? $_POST['second'] : '';
		$date = isset($_POST['date']) ? $_POST['date'] : '';
		
		if (empty($hour) & empty($minute) & empty($second) & empty($date)) {
			$success = shell_exec('date +"%a %b %d, %I:%M:%S %p"');
		} else {
			// Inorder to make it work need to follow this tutorial:
			//http://superuser.com/questions/510691/linux-date-s-command-not-working-to-change-date-on-a-server
			$success = shell_exec('sudo date --set="' . $date . ' ' . $hour . ':' . $minute . ':' . $second . '"');
		}
		break;
}

$result = array(
	'error'		=> $error,
	'success'	=> $success
);

echo (json_encode($result));