<?php

$command = '-w';
$path = '/var/www/html/UnixLinuxProject/UnixPerlProject/testing.txt';

$result = shell_exec(' perl /var/www/html/UnixLinuxProject/UnixPerlProject/wc.pl ' . $command . ' ' . $path);
var_dump(json_decode($result));

