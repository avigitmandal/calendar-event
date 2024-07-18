<?php
require __DIR__ . '/vendor/autoload.php';

session_start();

if (!isset($_SESSION['access_token'])) {
    header('Location: index.php');
    exit();
}

$client = new Google_Client();
$client->setAccessToken($_SESSION['access_token']);

$service = new Google_Service_Calendar($client);

if (isset($_GET['id'])) {
    $calendarId = 'avigitmandal0@gmail.com';
    $service->events->delete($calendarId, $_GET['id']);
}

header('Location: list_events.php');
?>
