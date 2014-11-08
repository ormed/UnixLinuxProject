<?php

//$command = '-w';
//$path = '/var/www/html/UnixLinuxProject/UnixPerlProject/testing.txt';

//$result = shell_exec(' perl /var/www/html/UnixLinuxProject/UnixPerlProject/wc.pl ' . $command . ' ' . $path);

$result = shell_exec('/var/www/html/UnixLinuxProject/UnixPerlProject/bash_scripts/adduser dvir12');


var_dump($result);
