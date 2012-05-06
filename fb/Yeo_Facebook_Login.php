<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Yeo
 * Date: 4/22/12
 * Time: 12:49 PM
 * To change this template use File | Settings | File Templates.
 */
/*require_once('facebook.php');  */
require_once('facebook.php');
$facebook = new Facebook(array(
    'appId' => '116503068483967', // from Facebook
    'secret' => '82616cc74bd732e0c8eb12d40644498b', // from Facebook
    'cookie' => true
));

//retriving session
$session = $facebook->getSession();
//requesting me to API
$me = null;
if ($Session) {
    try
    {
        $uid = $facebook->getUser();
        $me = $facebook->api('/me');
    }
    catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
    }
}

if ($me) {
    $logoutUrl = $facebook->getLogoutUrl(array(
        'next' => 'http://localhost:8080/fb/logout.php'

    ));

}
else
{
    $loginUrl = $facebook->getLoginUrl(array(
        'next' => 'http://localhost:8080/fb/login.php'
    ));
}

if ($user) {
    try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
    } catch (FacebookApiException $e) {
        echo $e->getMessage();

    }
}

?>

<!doctype html>

<html xmlns:fb="http://www.facebook.com/2008/fbml"

<head>
    <title>My Account Test</title>
</head>

<body>
<?php if ($me): ?>
    <?php echo "Welcome, " . $me['first_name'] . ".<br />"; ?>
<a href="<?php echo $logoutUrl; ?>">
    <img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif">
</a>
    <?php else: ?>
<a href="<?php echo $loginUrl; ?>">
    <img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif">
</a>
    <?php endif ?>

</body>

</html>