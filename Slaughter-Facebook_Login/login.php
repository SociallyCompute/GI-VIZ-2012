<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

include 'facebook.php';


// Create our Application instance (replace this with your appId and secret)!
$facebook = new Facebook(array(
    'appId' => '173382036117025',
    'secret' => 'f753fc2a6ca668a4b60089837b9b56ad',
    'cookie' => true,

));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
    try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
    } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
    }
}

if ($user) {
    $logoutUrl = $facebook->getLogoutUrl(((array(
        'next' => 'http://localhost/Slaughter-Facebook_Login/destroy.php',
    ))));
} else {
    $loginUrl = $facebook->getLoginUrl((array(display => page)));
}
?>
<script>
    //this is JS SDK load & initialization code (for the login button)
    window.fbAsyncInit = function () {
        FB.init({
            appId:'173382036117025', //login status
            cookie:true, // enable cookies to allow the server to access the session
            xfbml:true  // parse XFBML
        });

        // Additional initialization code here
    };

    // Load the SDK Asynchronously
    (function (d) {
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement('script');
        js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    }(document));
</script>

<html>

<body>
<div id="fb-root"></div>

<head>
    <title>Facebook Login</title>
</head>
<?php if ($user): ?>
<a href="<?php echo $logoutUrl; ?>"><img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif"></a>
    <?php else: ?>
<a href="<?php echo $loginUrl; ?>">
    <div class="fb-login-button"></div>
</a>
    <?php endif ?>

<p></p>

<?php if ($user): ?>
<h3>You</h3>
<img src="https://graph.facebook.com/<?php echo $user; ?>/picture">
    <?php echo $user; ?>

<h3>Your User Object (/me)</h3>
<pre><?php print_r($user_profile); ?></pre>
    <?php else: ?>
<strong><em>You are not Connected.</em></strong>
    <?php endif ?>


</body>
</html>



