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

require './facebook-php-sdk-6c82b3f/src/facebook.php';

$facebook = new Facebook(array(
    'appId' => '298421933568407',
    'secret' => '06b22c0532491b4d1afab19fae6c69fa'
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
    $logoutUrl = $facebook->getLogoutUrl(array(
        'next' => 'http://localhost/facebook/logout.php',
    ));

} else {
    $loginUrl = $facebook->getLoginUrl();
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml">

<body>
<h1>PHP Facebook Login /Logout Test</h1>

<h1>Activity 3.6</h1>

<?php
if ($user) {

    echo"<h2>Logout of Facebook account please:</h2>";
    echo"<a href='$logoutUrl'>Logout</a>";
}
else {

    echo"<h2>Login using your Facebook account please:</h2>";
    echo "<a href='$loginUrl'>Login with Facebook</a>";
}
?>

</body>
</html>