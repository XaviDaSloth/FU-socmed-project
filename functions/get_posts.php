<?php
require "../functions/session_check.php";
require "database.php";
$userID = $_SESSION['user_id'];
$connectDB = new Database('localhost','root', '', 'finals');

require "getInfo.php";
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "finals";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

$stmt = $conn->prepare("SELECT users.user_id, username, content, profile_picture, Timestamp FROM posts INNER JOIN users ON posts.user_id = users.user_id ORDER BY timestamp DESC ");


if ($stmt) {
    $stmt->execute();
    $stmt->bind_result($targetUserID, $username, $content, $profilePicture, $timestamp);
    

    while ($stmt->fetch()) {
        $following = "<button type='submit' name='follow-user' class='follow' id='follow' style='margin-left: 30px;' value='$targetUserID'>Follow</button>";
        if ($connectDB->isFollowing($userID, $targetUserID)) {
            $following = "<button type='submit' name='unfollow-user' class='follow' id='follow' style='margin-left: 30px;' value='$targetUserID'>Unfollow</button>";
        }

        echo "
            <div class='flex-posts'>
                <div class='div-posts-name'>
                    <img src= ../images/$profilePicture class='post-image'>
                    <a href='userpage.php?userID=$targetUserID'><h3>$username</h3></a>
                    <p>$timestamp</p>
                    <form action='' method= 'POST' style='display: inline'>
                    <input type='hidden' name='targetUserID' value='$targetUserID'>
                    
                    $following
                    </form>
                    <i class='fa-solid fa-ellipsis-vertical fa-lg'></i>
                    <span class='separator'></span>
                </div>
                <div class='div-posts-content'>
                    $content
                </div>
                <div class='div-posts-reactions'>
                    <div><i class='fa-regular fa-thumbs-up fa-xl'></i><p>20</p></div>
                </div>
            </div>
        ";
    }

    $stmt->close(); // Close the prepared statement
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();

?>