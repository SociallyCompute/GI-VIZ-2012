<?php
/**
 * Created by JetBrains PhpStorm.
 * User:
 * Date: 4/26/12
 * Time: 12:11 AM
 * To change this template use File | Settings | File Templates.
 */
//comments......
require 'facebook.php';

session_start();
session_destroy();
header('Location: Li-facebook-login.php');
?>