<?php 
include_once('../parts/help_functions.php');

$text = $_POST['text-editor'];
$file = $_POST['current-file'];

$lines = explode("\r\n", $text);

$error = '';
$success = 'File has been updated!';

for($i=0; $i<count($lines); $i++) {
	if ($i == 0) {
		// first save the first line
		$error .= shell_exec('sudo echo "' . $lines[$i] . '" > ' . $file);
	}
	
	$error .= shell_exec('sudo echo "' . $lines[$i] . '" >> ' . $file);
	
	debug('sudo echo "' . $lines[$i] . '" >> ' . $file, TRUE);
}


$result = array(
	'error'		=> $error,
	'success'	=> $success
);

echo json_encode($result);
