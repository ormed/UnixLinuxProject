<?php 
include_once('../parts/help_functions.php');

$performing_user = 'root';

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
