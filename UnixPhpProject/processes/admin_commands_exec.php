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
		$home_dir = $_POST['home-dir'];
		
		//$error = password_validateion
		if($password != $repassword) {
			$error = 'Opps! It seems like the passwords does not match.';
			
			break;	
		}
		
		if(empty($home_dir)) {
			$home_dir = '/home/' . $user;	
		}
		
    	$success = shell_exec('sudo useradd -d' . $home_dir .' ' . $user . ' -c ' . $full_name);
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
		
	case 'ch_permission':
		$path = $_POST['path'];
		$owner = $_POST['owner'];
		$owner_access = $_POST['owner-access'];
		$group = $_POST['group'];
		$group_access = $_POST['group-access'];
		$others_access = $_POST['others-access'];

		// check if file or directory
		if (!isset($allow_execute)) {
			$allow_execute = $_POST['allow-execute'];
			
			$error = shell_exec('sudo chown ' . $owner . ' ' . $path);
			$error .= shell_exec('sudo chgrp ' . $group . ' ' . $path);
			//build chmod number 
			$chmod_num = (intval($owner_access) * 100) + (intval($group_access) * 10) + intval($others_access);
			$chmod_num = ($allow_execute) ? ($chmod_num + 111) : $chmod_num;
			$error .= shell_exec('sudo chmod ' . $chmod_num . ' ' . $path);
			
		} else {
			$error = shell_exec('sudo chown ' . $owner . ' ' . $path);
			$error .= shell_exec('sudo chgrp ' . $group . ' ' . $path);
			$error .= shell_exec('sudo chmod ' . $chmod_num . ' ' . $path);
		}
		
		$success = 'Permissions updated';
		break;
}

$result = array(
	'error'		=> $error,
	'success'	=> $success
);

echo (json_encode($result));