<?php

require 'config.php';

//ovewrites the cookie
$facebook->setSession(null);

header('Location: http://localhost:8080/fb/Yeo_Facebook_Login.php');
?>
