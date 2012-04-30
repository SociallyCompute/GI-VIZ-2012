<?php
/**
 * Copyright 2011 Facebook, Inc.
 */

include 'facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
    'appId' => '160389030755834',
    'secret' => '8a9bc37ac30954918a7b98f019733251',
    'cookie' => true,

));
session_start();
session_destroy();

header('Location: Smith-Facebook-Login.php');
?>