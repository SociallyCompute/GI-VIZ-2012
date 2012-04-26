<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Dom
 * Date: 4/17/12
 * Time: 3:35 PM
 * To change this template use File | Settings | File Templates.
 */
require 'facebook.php';

$facebook = new Facebook(array(
    'appId' => '368661086503784',
    'secret' => '2e9f6d907ed30aab11ce581cf67ac7f8',
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
    $logoutUrl = $facebook->getLogoutUrl(array('next' => 'http://localhost/PhpstormProjects/roccoDomenic/fb/logout.php'));
} else {
    $loginUrl = $facebook->getLoginUrl();
}

?>

<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <title>Facebook PHP SDK Login Example</title>
</head>
<body>
<h1>Facebook PHP SDK Login Example</h1>
<?php
if ($user) {
    echo "Welcome " . $user_profile['name'] . "!<br />";
    echo "<a href='$logoutUrl'>Logout</a>";
} else {
    echo "<a href='$loginUrl'>Login</a>";
}
?>
</body>
</html>