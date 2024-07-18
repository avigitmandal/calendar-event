<?php
require __DIR__ . '/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfig('credentials.json');
$client->setRedirectUri('http://localhost/calendar-event/oauth2callback.php');
$client->addScope(Google_Service_Calendar::CALENDAR);

if (!isset($_SESSION['access_token']) || $_SESSION['access_token']) {
    $authUrl = $client->createAuthUrl();
    echo "<a href='$authUrl'>Connect to Google Calendar</a>";
} else {
    header('Location: list_events.php');
}
?>
