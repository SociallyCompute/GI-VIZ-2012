<?php

require 'config.php';

$session = $facebook->getSession();

header('Location: http://localhost:8080/fb/Yeo_Facebook_Login.php');
?>