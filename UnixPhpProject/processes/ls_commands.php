<?php
 
$command = $_POST['ls-option'];
$path = $_POST['path'];

$result = shell_exec('cd /var/www/html/UnixLinuxProject/UnixPerlProject/;perl ls.pl ' . $command . ' ' . $path);
echo ($result);