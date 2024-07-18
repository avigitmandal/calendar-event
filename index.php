<?php
require __DIR__ . '/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfig('credentials.json');
$client->setRedirectUri('http://localhost/calendar-event/oauth2callback.php');
$client->addScope(Google_Service_Calendar::CALENDAR);


?>
