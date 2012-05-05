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


$user = $facebook->getUser();


if ($user) {
    try {
        $user_profile = $facebook->api('/me');
    } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
    }
}

if ($user) {
    $logoutUrl = $facebook->getLogoutUrl(((array(
        'next' => 'http://localhost/smith-facebook-login/destroy.php',
    ))));
} else {
    $loginUrl = $facebook->getLoginUrl();
}
?>

<html>

<body>
<head>
    <title>Facebook Login</title>
</head>

<?php if ($user): ?>
<a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
<a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
    <?php endif ?>

<p></p>



