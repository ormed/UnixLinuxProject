<?php

$command = '-a';
$path = '/var/www/html/';

$result = shell_exec(' perl /var/www/html/UnixLinux/ls.pl ' . $command . ' ' . $path);
var_dump($result);

