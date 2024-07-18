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
