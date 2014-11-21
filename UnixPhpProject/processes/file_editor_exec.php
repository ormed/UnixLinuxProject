<?php 
@session_start();

include_once('../parts/help_functions.php');
header('Content-type: application/json');

if (!isset($_SESSION['user'])) {
	$result = array(
		'error'		=> 'You are not logged in!',
		'success'	=> $success
	);
	echo (json_encode($result));
	exit;
}


$performing_user = $_SESSION['user'];

$text = $_POST['text-editor'];
$file = $_POST['current-file'];

$lines = explode("\r\n", $text);

$error = '';
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


$result = array(
	'error'		=> $error,
	'success'	=> $success
);

echo json_encode($result);
