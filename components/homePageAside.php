<?php

$show_mn = "messenger.php";

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'show_followers') {
        $show_mn = "messenger.php";
    } elseif ($_POST['action'] == 'show_following') {
        $show_mn = "notification.php";
    }
    
}

 
if (isset($_POST['follow'])) {
    $targetUserID = $_POST['target_user_id'];   
    $connectDB->followUser($userID, $targetUserID);
    echo "Now following user.";
} elseif (isset($_POST['unfollow'])) {
    $targetUserID = $_POST['target_user_id'];   
    $connectDB->unfollowUser($userID, $targetUserID);
    echo "You have unfollowed the user.";
}


require '../functions/getInfo.php';

$followerCount = $connectDB->getFollowerCount($userID);
$followingCount = $connectDB->getFollowingCount($userID);
?>

<a href="homepage.php?showSettings=true" class="settings-div">
    <img src="../images/settings.png" alt="Settings" class="settings">
</a>
<div class="flex-aside">
    <div class="flex-profile">
        <div class="profile-picture">
            <img src="../images/<?php echo $profile_picture?>">
        </div>
        <div class="profile-name">
            <a href="../pages/userpage.php"><h2><?php echo $username;?></h2></a>
        </div>
    </div>
    <form method="POST">
        <div class="flex-mn">
            <div class="mn-buttons">
                <button type="submit" name="action" value="show_followers" class="mn-button messenger">
                    <p><?php echo $followerCount?> followers</p>
                </button>
                <button type="submit" name="action" value="show_following" class="mn-button notification">
                    <p><?php echo $followingCount?> following</p>
                </button>
            </div>
            <div class="mn-container">
                <?php 
                require $show_mn;
                ?>
            </div>
        </div>
    </form>
    <div class="footer">
        All Rights Reserved 2024
    </div>
</div>