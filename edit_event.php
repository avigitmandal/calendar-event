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
    $event = $service->events->get('avigitmandal0@gmail.com', $_POST['id']);
    $event->setSummary($_POST['summary']);
    $event->setStart(new Google_Service_Calendar_EventDateTime(['dateTime' => $_POST['start'], 'timeZone' => 'Asia/Kathmandu']));
    $event->setEnd(new Google_Service_Calendar_EventDateTime(['dateTime' => $_POST['end'], 'timeZone' => 'Asia/Kathmandu']));

    $service->events->update('avigitmandal0@gmail.com', $event->getId(), $event);
    header('Location: list_events.php');
} else {
    $event = $service->events->get('avigitmandal0@gmail.com', $_GET['id']);
    $summary = $event->getSummary();
    $start = date('Y-m-d\TH:i', strtotime($event->getStart()->getDateTime()));
    $end = date('Y-m-d\TH:i', strtotime($event->getEnd()->getDateTime()));
}
?>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <label for="summary">Event Summary:</label>
    <input type="text" name="summary" id="summary" value="<?php echo $summary; ?>" required><br><br>
    <label for="start">Start DateTime:</label>
    <input type="datetime-local" name="start" id="start" value="<?php echo $start; ?>" required><br><br>
    <label for="end">End DateTime:</label>
    <input type="datetime-local" name="end" id="end" value="<?php echo $end; ?>" required><br><br>
    <button type="submit">Update Event</button>
</form>
