<?php
require 'facebook.php';
//comments...
$facebook = new Facebook(array(
    'appId' => '227636627338538',
    'secret' => 'b182fb7acb29d888d4570c6f13b60037',
    'cookies' => true,
));

//2. retrieving session
$user = $facebook->getUser();

//3. requesting 'me' to API

if ($user) {
    try {
        $user_profile = $facebook->api('/me');

    } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
    }
}

//4. login or logout
if ($user) {
    $logoutUrl = $facebook->getLogoutUrl(array(
        'next' => 'http://localhost/Li-logout.php',
    ));
} else {
    $loginUrl = $facebook->getLoginUrl();
}
?>

<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <title>Facebook-Login-Logout-Example</title>
</head>
<body>
<?php
if ($user) {
    echo "Welcome," . $user_profile ['last_name'] . ".<br />";
    echo "<a href='$logoutUrl'>LogOut</a>";
} else {
    echo "<a href='$loginUrl'> Please Login with Facebook</a>";
}
?>
</body>
</html>