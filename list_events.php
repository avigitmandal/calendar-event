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

$calendarId = 'avigitmandal0@gmail.com';
$events = $service->events->listEvents($calendarId);

echo "<h1>Events List</h1>";
echo "<a href='create_event.php'>Create Event</a><br><br>";

foreach ($events->getItems() as $event) {
    echo $event->getSummary() . " (" . $event->getStart()->getDateTime() . ")";
    echo " <a href='edit_event.php?id=" . $event->getId() . "'>Edit</a>";
    echo " <a href='delete_event.php?id=" . $event->getId() . "'>Delete</a><br>";
}
?>
