<?php


require_once('vendor/autoload.php');

$conn = mysqli_connect('localhost','root','','practice_signin_with_google');


$google_client  = new Google_Client();

$google_client->setClientId('365150334039-06g8tf8v1bbvgtid2uor0t1feqg7ppsm.apps.googleusercontent.com');
$google_client->setClientSecret('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');

$google_client->setRedirectUri('http://localhost/google-APi/practice_signin-with-google/index.php');

$google_client->addScope('email');
$google_client->addScope('profile');

session_start();


?>