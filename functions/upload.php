<?php
require "../functions/database.php";
require "../functions/session_check.php";

$userID = $_SESSION['user_id'];
$connectDB = new Database('localhost','root', '', 'finals');

if (isset($_POST['upload'])) {

    $filename = $_FILES["fileToUpload"]["name"];
    $tempname = $_FILES["fileToUpload"]["tmp_name"];
    $folder = "../images/" . $filename;

    if($connectDB->addImage($userID, $filename)){
        echo "SUCCESS";
    }

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>&nbsp; Image uploaded successfully!</h3>";
        header("Location: ../pages/accountSettings.php");
        exit(0);
    } else {
        echo "<h3>&nbsp; Failed to upload image!</h3>";
        exit(0);
    }
}
?>
