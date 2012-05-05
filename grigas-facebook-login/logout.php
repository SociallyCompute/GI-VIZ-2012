<?php
/**
 * File Name: logout.php
 * Drexel University
 * INFO 655 Intro to Web Programming
 * User: Tom Grigas
 * Date: 4/26/12
 * Time: 7:10 PM
 *
 */
session_start();
session_destroy();

header('Location: http://localhost/facebook/index.php');

?>