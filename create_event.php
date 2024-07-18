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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event = new Google_Service_Calendar_Event(array(
        'summary' => $_POST['summary'],
        'start' => array(
            'dateTime' => $_POST['start'],
            'timeZone' => 'Asia/Kathmandu',
        ),
        'end' => array(
            'dateTime' => $_POST['end'],
            'timeZone' => 'Asia/Kathmandu',
        ),
    ));

    $calendarId = 'avigitmandal0@gmail.com';
    $service->events->insert($calendarId, $event);
    header('Location: list_events.php');
}
?>

<form method="POST">
    <label for="summary">Event Summary:</label>
    <input type="text" name="summary" id="summary" required><br><br>
    <label for="start">Start DateTime:</label>
    <input type="datetime-local" name="start" id="start" required><br><br>
    <label for="end">End DateTime:</label>
    <input type="datetime-local" name="end" id="end" required><br><br>
    <button type="submit">Create Event</button>
</form>
