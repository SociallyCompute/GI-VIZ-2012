<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Dom
 * Date: 4/25/12
 * Time: 8:53 PM
 * To change this template use File | Settings | File Templates.
 */

require 'rocco-facebook-login.php';

$facebook->destroySession();

header('Location: http://localhost/PhpstormProjects/roccoDomenic/fb/rocco-facebook-login.php');

?>