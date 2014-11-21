<?php

$performing_user = 'root';

$command = $_POST['command'];

$result = shell_exec('sudo su -c "' . $command . '" -s /bin/sh ' .  $performing_user . ' 2>&1');

echo (json_encode($result));