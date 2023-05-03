<?php
//require_once('../private/initialize.php');
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
include(PRIVATE_PATH . '/class/user.class.php');
$user = new User();
$user->logout();
