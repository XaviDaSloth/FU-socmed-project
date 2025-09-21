<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "finals";
require "../functions/database.php";

// Connect to the database
$connectDB = new Database($hostname, $username, $password, $dbname);

// Fetch posts for the given user ID
$userID = $_GET['userID'] ?? null; // Check if userID is set in the query string
if ($userID) {
    $postsJson = $connectDB->getPosts($userID);
} else {
    echo "User ID is not provided.";
    exit();
}

$getPosts = json_decode($postsJson, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Error decoding JSON: " . json_last_error_msg();
    exit; // Stop execution if there's an error
}

?>

<div class="flex-posts">
    <?php if (!empty($getPosts)): // Check if there are posts ?>
        <?php foreach ($getPosts as $post): ?>
            <?php
            $username = htmlspecialchars($post['username']); 
            $timestamp = htmlspecialchars($post['timestamp']);
            $content = nl2br(htmlspecialchars($post['content']));
            ?>
            <div class="div-posts-name">
                <h3><?php echo $username; ?></h3>
                <p><?php echo $timestamp; ?></p>
                <p id="follow">Follow</p>
                <i class="fa-solid fa-ellipsis-vertical fa-lg"></i>
                <span class="separator"></span>
            </div>
            <div class="div-posts-content">
                <?php echo $content; ?>
            </div>
            
        <?php endforeach; ?>
    <?php else: ?>
        <p>No posts available.</p> <!-- Message for no posts -->
    <?php endif; ?>
</div>
