<?php
require "database.php"; 
$connectDB = new Database('localhost', 'root', '', 'finals');

if(isset($_POST['input'])){
    $input = $_POST['input'];
    $users = json_decode($connectDB->getUsers($input), true);

    if(!empty($users)) {
        foreach($users as $user) {
            echo "<div class='search_user'><a href='userpage.php?userID={$user['user_id']}'><h3 style='color: black;'>{$user['username']}</h3></a></div>";
        }
    } else {
        echo ""; // No results found
    }
}
?>
