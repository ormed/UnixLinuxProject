<?php
 
$command = $_POST['ls-option'];
$path = $_POST['path'];

$result = shell_exec(' perl /var/www/html/UnixLinuxProject/UnixPerlProject/ls.pl ' . $command . ' ' . $path);
echo ($result);