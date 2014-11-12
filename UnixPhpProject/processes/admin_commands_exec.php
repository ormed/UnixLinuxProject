<?php
header('Content-type: application/json');

$user = $_POST['user-name'];
$password = $_POST['password'];
$command = $_POST['re-password'];



switch ($page) {
	case 'add_user':
    	$result = shell_exec('useradd ' . $user . ' | ' . 'passwd ' . $user);
    	break;
	case 'remove_user':
    	$result = shell_exec('cut -d : -f 1 /etc/passwd');
    	break;
}

echo ($result);