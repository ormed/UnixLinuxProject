<?php

$page = $_POST['page'];
$option = $_POST['option'];
$path = $_POST['path'];

$result = array();

switch ($page) {
  case 'ls':
    $result = shell_exec('perl /var/www/html/UnixLinuxProject/UnixPerlProject/ls.pl ' . $option . ' ' . $path);
    break;
  case 'more':
    $result = shell_exec('perl /var/www/html/UnixLinuxProject/UnixPerlProject/more.pl ' . $option . ' ' . $path);
    break;
} 




echo ($result);