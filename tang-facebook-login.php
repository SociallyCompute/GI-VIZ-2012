<?php

define('341247812602333', '341247812602333');

//uses the PHP SDK.  Download from https://github.com/facebook/php-sdk
require 'facebook.php';

$facebook = new Facebook(array(
    'appId' => 341247812602333,
    'secret' => '4ad002c966486e4c4744469a3fd18f9',
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
    window.fbAsyncInit = function () {
        FB.init({
            appId:'<?= 341247812602333 ?>',
            status:true,
            cookie:true,
            xfbml:true,
            oauth:true,
        });

        FB.Event.subscribe('auth.login', function (response) {
            window.location.reload();
        });
    };

    (function (d) {
        var js, id = 'facebook-jssdk';
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement('script');
        js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        d.getElementsByTagName('head')[0].appendChild(js);
    }(document));
</script>
</body>
</html>