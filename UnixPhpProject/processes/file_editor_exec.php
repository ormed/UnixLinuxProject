<?php 
@session_start();

include_once('../parts/help_functions.php');
header('Content-type: application/json');

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


$performing_user = $_SESSION['user'];

$page = $_POST['page'];
$file = $_POST['current-file'];

if ($page == 'edit') {
	$text = $_POST['text-editor'];

	$lines = explode("\r\n", $text);
	$success = 'File has been updated!';

	for($i=0; $i<count($lines); $i++) {
	
		if ($i == 0) {
			// first save the first line
			$error .= shell_exec('sudo su -c "echo \"' . addslashes($lines[$i]) . '\" > ' . $file . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
		} else {
			$error .= shell_exec('sudo su -c "echo \"' . addslashes($lines[$i]) . '\" >> ' . $file . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
		}
		
		if (!empty($error)) {
			break;
		}
	}
} elseif ($page == 'grep') {
	$search = $_POST['search'];
	
	$success = shell_exec('sudo su -c "grep ' . $search . ' ' . $file . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
	
	if (empty($success)) {
		$error = 'Couldn\'t find "' . $search . '" in file';
	}
} elseif ($page == 'sed') {
	
}

$result = array(
	'error'		=> $error,
	'success'	=> $success
);

echo json_encode($result);
