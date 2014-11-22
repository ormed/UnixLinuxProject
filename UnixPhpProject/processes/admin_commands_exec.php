<?php
@session_start();

header('Content-type: application/json');
include_once('../parts/help_functions.php');

$error = '';
$success = '';

if (!isset($_SESSION['user'])) {
	$result = array(
		'error'		=> 'You are not logged in!',
		'success'	=> $success
	);
	echo (json_encode($result));
	exit;
}


$performing_user = $_SESSION['user']; // This is the user which performs the commands

$page = $_POST['page'];


switch ($page) {
	case 'add_user':
		$user = $_POST['user-name'];
		$full_name = $_POST['full-name'];
		$password = $_POST['pwd'];
		$repassword = $_POST['repwd'];
		$home_dir = $_POST['home-dir'];
		
		//$error = password_validateion
		$error .= passwordValidateion($user, $password, $repassword);
		
		if (!empty($error)) {
			break;
		}
		
		if(empty($home_dir)) {
			$home_dir = '/home/' . $user;
		}
		
    	$error .= shell_exec('sudo su -c "useradd -d ' . $home_dir .' ' . $user . ' -c ' . escapeshellarg($full_name) . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
		$error .= shell_exec('echo ' . escapeshellarg($password) . ' | sudo  su -c "passwd ' . $user . ' --stdin" ' . '" -s /bin/sh ' .  $performing_user  . ' 2>&1');
		
		$success .= 'User ' . $user . ' has been added.';
    	break;

	case 'remove_user':
		$rm_user = $_POST['option'];

    	$error = shell_exec('sudo su -c "userdel ' . $rm_user . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
		$success = $rm_user . ' has been deleted.';
    	break;
		
	case 'edit_user':
		$user = $_POST['old-user'];
		$new_user = $_POST['new-user-name'];
		$full_name = $_POST['full-name'];
		$password = $_POST['pwd'];
		$repassword = $_POST['repwd'];
		$home_dir = $_POST['home-dir'];
		
		$error .= passwordValidateion($user, $password, $repassword);
		
		if (!empty($error)) {
			break;
		}
		// first update all info
		$error .= shell_exec('sudo su -c "usermod -md ' . $home_dir . ' ' . $user . '" -s /bin/sh ' .  $performing_user . ' 2>&1'); //change home dir and move the old one there
		
		if (!empty($error)) {
			break;
		}
		
		$error .= shell_exec('sudo su -c "usermod -c "' . $full_name . '" ' . $user . '" -s /bin/sh ' .  $performing_user . ' 2>&1'); // update full name
		
		if (!empty($error)) {
			break;
		}
		
		$error .= shell_exec('echo ' . $password . ' | sudo su -c "passwd ' . $user . ' --stdin' . '" -s /bin/sh ' .  $performing_user . ' 2>&1'); // change the password
		
		if (!empty($error)) {
			break;
		}
		
		$error .= shell_exec('sudo su -c "usermod -l ' . $new_user . ' ' . $user . '" -s /bin/sh ' .  $performing_user . ' 2>&1'); // last we update the user name
		
		$success = 'User has been updated';
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
			$test = shell_exec('sudo su -c "date --set=\"' . $date . ' ' . $hour . ':' . $minute . ':' . $second . '\"' . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
			
			if (preg_match("/date: cannot set date: Operation not permitted/", $test)) {
				$error = 'date: cannot set date: Operation not permitted';
			}
			
			$success .= 'Date has been updated';
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
		if (!isset($_POST['allow-execute'])) {
			$allow_execute = $_POST['allow-execute'];
			
			$error = shell_exec('sudo su -c "chown ' . $owner . ' ' . $path . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
			
			if (!empty($error)) {
				break;
			}
			
			$error .= shell_exec('sudo su -c "chgrp ' . $group . ' ' . $path . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
			
			if (!empty($error)) {
				break;
			}
			
			//build chmod number 
			$chmod_num = (intval($owner_access) * 100) + (intval($group_access) * 10) + intval($others_access);
			$chmod_num = ($allow_execute) ? ($chmod_num + 111) : $chmod_num;
			$error .= shell_exec('sudo su -c "chmod ' . $chmod_num . ' ' . $path . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
			
		} else {
			$error = shell_exec('sudo su -c "chown ' . $owner . ' ' . $path . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
			
			if (!empty($error)) {
				break;
			}
			
			$error .= shell_exec('sudo su -c "chgrp ' . $group . ' ' . $path . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
			
			if (!empty($error)) {
				break;
			}
			
			$error .= shell_exec('sudo su -c "chmod ' . $chmod_num . ' ' . $path . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
		}
		
		$success = 'Permissions updated';
		break;
		
	case 'backup':
		$path = $_POST['path'];
		$files = $_POST['files-to-backup'];
		$backup_to = $_POST['backup-to'];
		$file_name = $_POST['file-name'];
		
		$error = shell_exec('sudo su -c "cd ' . $backup_to . ' &&  tar -cf ' . $file_name . '.tar ' . $files . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
		shell_exec('sudo su -c "mv ' . $path . $file_name . '.tar ' . $backup_to . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
		
		$success = 'Backup file was created at: ' . $backup_to;
		break;
		
	case 'restore':
		$path = $_POST['path'];
		$file_name = $_POST['name'];
		$error = shell_exec('sudo su -c "cd ' . $path . ' &&  tar -xvf ' . $file_name . '.tar" -s /bin/sh ' .  $performing_user . ' 2>&1');
		
		$arr = explode(" ", $error);
		
		if(is_array($arr) && $arr[0] != 'tar:') {
			$error = "";
			$success = 'Files has been restored.';
		}
		break;
}

$result = array(
	'error'		=> $error,
	'success'	=> $success
);

echo (json_encode($result));
