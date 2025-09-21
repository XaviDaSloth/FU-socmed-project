<?php
if (isset($_SESSION['user_id'])) {
  $userID = $_SESSION['user_id'];
}
$connectDB = new Database('localhost','root', '', 'finals');

$userID = $_GET['userID'] ?? null; 

echo $userID;
$followers = $connectDB->getFollowerCount($userID);
$following = $connectDB->getFollowingCount($userID);
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
            <h2><?php echo $username?></h2>
        </div>
        <div class="profile-follows">
            <p><?php echo $followers?> followers</p>
            <p><?php echo $following?> following</p>
        </div>
    </div>
    <div class="user-data">
      <div>
        <p>Name:</p>
        <p><?php echo $name?></p>
      </div>
      <div>
        <p>Date of Birth:</p>
        <p><?php echo $dob?></p>
      </div>
      <div>
        <p>Sex:</p>
        <p><?php echo $gender?></p>
      </div>
      <div>
        <p>College:</p>
        <p><?php echo $college?></p>
      </div>
    </div>
    <div class="footer">
        All Rights Reserved 2024
    </div>
</div>