<?php

$firstname = array('Sanjana', 'Hiya', 'Omi', 'Kalam', 'Humayon', 'Humayon');
$lastname = array('Seikh', 'Zaman', 'Khan', 'Hasan', 'Islam');

echo 'Name : '.$firstname[array_rand($firstname, 1)].' '.$lastname[array_rand($lastname, 1)].'<br>';



$randDate=date('Y-m-d h:i:s', mt_rand(strtotime('2021-01-01'), time()));

echo $randDate;