<?php
require_once '../GoogleAPI/vendor/autoload.php';
// init configuration
$clientID = '147204771760-hdrn2bpofasqcdqroattts5vs58hokg4.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/Marketing/public/signup.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");





$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'marketing';

$con = mysqli_connect($host, $user, $pass, $db);
?>