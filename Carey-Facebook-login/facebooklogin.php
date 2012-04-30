<?php
/*
2012-04-29 Matt Carey - INFO655
Much of the code here was 'borrowed' from: http://developers.facebook.com/docs/reference/php/facebook-api/

Still need to get app id as facebook believes my account is fraudulent :(
*/
require_once("facebooksdk/src/facebook.php");

$config = array();
$config['appId'] = 'YOUR_APP_ID';
$config['secret'] = 'YOUR_APP_SECRET';
$config['fileUpload'] = false; // optional

$facebook = new Facebook($config);

// is the user already logged in?

$uid = $facebook->getUser();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head><title>Carey Facebook Login</title></head>
<body>

<?php
$loginMessage = 'You are not currently logged in.';
if ($uid) {
    // We have a user ID, so probably a logged in user.
    // If not, we will get an exception, which we handle below.
    try {
        $user_profile = $facebook->api('/me', 'GET');
        echo "Name: " . $user_profile['name'];
    } catch (FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl();
        echo '<h2>';
        echo $loginMessage . '<br>';
        echo 'Please <a href="' . $login_url . '">login.</a>';
        echo '</h2>';
        error_log($e->getType());
        error_log($e->getMessage());
    }
} else {

    // No user, print a link for the user to login
    $login_url = $facebook->getLoginUrl();
    echo '<h2>';
    echo $loginMessage . '</br>';
    echo 'Please <a href="' . $login_url . '">login.</a>';
    echo '</h2>';
}

?>

</body>
</html>