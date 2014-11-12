<?php 
include_once('../parts/help_functions.php');

$text = $_POST['text-editor'];
$file = $_POST['current-file'];

$result = shell_exec('sudo echo ' . escapeshellarg($text) . ' > ' . $file);

echo $result;
