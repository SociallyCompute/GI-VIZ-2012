<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 *
 * Updated by Benjamin Toll on 4/26 for INFO 655, Spring 2012 @ Drexel University
 */

require '../src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
    'appId' => '237737169666810',
    'secret' => '2de1ae2fd1e55338f7545bc5bedc7cf0',
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

// Login or logout url will be needed depending on current user state.
if ($user) {
    $logoutUrl = $facebook->getLogoutUrl(array('next' => 'http://localhost/INFO655/Activity3.6/logout.php')); // This logout page clears the php session for a clean logout
} else {
    $loginUrl = $facebook->getLoginUrl();
}

// This call will always work since we are fetching public data.
$naitik = $facebook->api('/naitik');

?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <title>php-sdk</title>
    <style>
        body {
            font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
        }

        h1 a {
            text-decoration: none;
            color: #3b5998;
        }

        h1 a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<h1>php-sdk</h1>

<?php if ($user): ?>
<a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
<div>
    Login using OAuth 2.0 handled by the PHP SDK:
    <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
</div>
    <?php endif ?>

<h3>PHP Session</h3>
<pre><?php print_r($_SESSION); ?></pre>

<?php if ($user): ?>
<h3>You</h3>
<img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

<h3>Your User Object (/me)</h3>
<pre><?php print_r($user_profile); ?></pre>
    <?php else: ?>
<strong><em>You are not Connected.</em></strong>
    <?php endif ?>
</body>
</html>