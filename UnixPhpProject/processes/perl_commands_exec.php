<?php
@session_start();

include_once('../parts/help_functions.php');
header('Content-type: application/json');

if (!isset($_SESSION['user'])) {
	$result = 'You are not logged in!';
	echo (json_encode($result));
	exit;
}

$performing_user = $_SESSION['user'];


$page = $_POST['page'];
$option = $_POST['option'];
$path = $_POST['path'];

$result = array();

//$path = escapeshellarg($path); // eascape path in case we have spaces in it 

switch ($page) {
	case 'ls':
    	$result = shell_exec('sudo su -c "perl /var/www/html/UnixLinuxProject/UnixPerlProject/ls.pl ' . $option . ' ' . $path . '" -s /bin/sh ' .  $performing_user);
    	break;
	case 'more':
    	$result = shell_exec('sudo su -c "perl /var/www/html/UnixLinuxProject/UnixPerlProject/more.pl ' . $option . ' ' . $path . '" -s /bin/sh ' .  $performing_user);
    	break;
    case 'wc':
    	$result = shell_exec('sudo su -c "perl /var/www/html/UnixLinuxProject/UnixPerlProject/wc.pl ' . $option . ' ' . $path . '" -s /bin/sh ' .  $performing_user);
    	break;
	case 'rm':
    	$result = shell_exec('sudo su -c "perl /var/www/html/UnixLinuxProject/UnixPerlProject/rm.pl ' . $option . ' ' . $path . '" -s /bin/sh ' .  $performing_user);
    	break;
	case 'find':
    	$result = shell_exec('sudo su -c "perl /var/www/html/UnixLinuxProject/UnixPerlProject/findv2.pl ' . $option . ' ' . $path . '" -s /bin/sh ' .  $performing_user);
    	break;
	case 'cp':
    	$result = shell_exec('sudo su -c "perl /var/www/html/UnixLinuxProject/UnixPerlProject/cp.pl -R ' . $option . ' ' . $path . '" -s /bin/sh ' .  $performing_user);
    	break;
} 


echo ($result);
