<?php

$command = '-a';
$path = '/var/www/html/';

$result = shell_exec(' perl /var/www/html/UnixLinuxProject/UnixPerlProject/ls.pl ' . $command . ' ' . $path);
var_dump(json_decode($result));

