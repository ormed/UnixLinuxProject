<?php
@session_start();

if (!isset($_SESSION['user'])) {
	$result = 'You are not logged in!';
	echo (json_encode($result));
	exit;
}

$performing_user = $_SESSION['user'];

$command = $_POST['command'];

$result = shell_exec('sudo su -c "' . $command . '" -s /bin/sh ' .  $performing_user . ' 2>&1');

echo (json_encode($result));