<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bede
 * Date: 4/30/12
 * Time: 5:56 PM
 * To change this template use File | Settings | File Templates.
 */

define('YOUR_APP_ID', 'YOUR APP ID');

//uses the PHP SDK.  Download from https://github.com/facebook/php-sdk
require 'facebook-php-sdk-6c82b3f/src/facebook.php';

$facebook = new Facebook(array(
    'appId'  => 328537787219330,
    'secret' => '17a9294abd346d03e9cae70ed981c53e',
));

$userId = $facebook->getUser();

?>

<html>
<body>
<?php if ($userId) {
    $userInfo = $facebook->api('/' + $userId); ?>
Welcome <?= $userInfo['name'] ?>
    <?php } else { ?>
<div id="fb-root"></div>
<fb:login-button></fb:login-button>
    <?php } ?>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '<?= YOUR_APP_ID ?>',
            status     : true,
            cookie     : true,
            xfbml      : true,
            oauth      : true,
        });

        FB.Event.subscribe('auth.login', function(response) {
            window.location.reload();
        });
    };

    (function(d){
        var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        d.getElementsByTagName('head')[0].appendChild(js);
    }(document));
</script>
</body>
</html>
Using the JavaScript SDK and PHP SDK together is only one of several ways to access user credentials and information from server-side code. Our Authentication Guide high

?>