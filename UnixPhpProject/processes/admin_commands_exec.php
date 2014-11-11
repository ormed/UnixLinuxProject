<?php

$command = $_POST['user-name'];
$command = $_POST['password'];
$command = $_POST['re-password'];


$result = shell_exec('sudo ' . $command);
