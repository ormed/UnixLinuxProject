<?php
include_once('../parts/help_functions.php');
header('Content-type: application/json');

$page = $_POST['page'];
$option = $_POST['option'];
$path = $_POST['path'];

$result = array();

$path = escapeshellarg($path); // eascape path in case we have spaces in it 

switch ($page) {
	case 'ls':
    	$result = shell_exec('sudo perl /var/www/html/UnixLinuxProject/UnixPerlProject/ls.pl ' . $option . ' ' . $path);
    	break;
	case 'more':
    	$result = shell_exec('sudo perl /var/www/html/UnixLinuxProject/UnixPerlProject/more.pl ' . $option . ' ' . $path);
    	break;
    case 'wc':
    	$result = shell_exec('sudo perl /var/www/html/UnixLinuxProject/UnixPerlProject/wc.pl ' . $option . ' ' . $path);
    	break;
	case 'rm':
    	$result = shell_exec('sudo perl /var/www/html/UnixLinuxProject/UnixPerlProject/rm.pl ' . $option . ' ' . $path);
    	break;
} 


echo ($result);
