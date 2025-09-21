<?php
require "../functions/database.php";
session_start();

$connectDB = new Database('localhost', 'root', '', 'finals');


header('Content-Type: application/json');

$content = $_POST['content'] ?? '';
$userID = $_SESSION['user_id'] ?? null;

if (empty($content) || empty($userID)) {
    die(json_encode(['status' => 'error', 'message' => 'Missing content or userID.']));
}

$result = $connectDB->postUser($userID, $content);
echo $result;
?>
