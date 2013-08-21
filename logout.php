<?php

require 'config.php';
require 'libs/facebook-php-sdk/src/facebook.php';

$facebook = new Facebook($FB_API_KEY);
$token = $facebook->getAccessToken();
$url = 'https://www.facebook.com/logout.php?next=' . $URL_WEBSITE .
		'&access_token=' . $token;

session_destroy();
header('Location: '.$url);

?>
