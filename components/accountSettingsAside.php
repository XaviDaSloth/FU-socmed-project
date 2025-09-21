<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['account-settings'])) {
      header("Location: ../pages/accountSettings.php");
      exit(); // Ensure script execution stops after a redirect
  } elseif (isset($_POST['logout'])) { // Assuming a separate button or key for logout
      require "logout.php";
  }
}

?>

<a href="homepage.php" class="settings-div">
    <img src="../images/back-button.png" alt="back" class="settings" style="width: 20px; height: 20px;">
</a>
<div class="flex-aside">
  <div>
    <form method="POST">
      <div class = "options-div" style="margin-top: 25px;">
        <button class="option Login" name="account-settings" >Account Settings</button>
        <button class="option Register" name="log-out">Log Out</button>
      </div>
      <div class = "logo-div">
        <img src="../images/logo.png" alt="Greyhounds" class="logo-image">
      </div>
    </form>
  </div>
  <div class = "footer"> 
      All Rights Reserved 2024
  </div>
</div>