<?php

require "../functions/database.php";
require "../functions/session_check.php";

$userID = $_SESSION['user_id'];
$showOptions = "../components/mini/blank.php";
$connectDB = new Database('localhost','root', '', 'finals');
require '../functions/getInfo.php';
$verifyOldPass = true;
$verifyNewPass = true;
$success =false;
$successData = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  if(isset($_POST['changePass'])){
    $showOptions = "../components/mini/changePass.php";
  }else if(isset($_POST['changeData'])){
    $showOptions = "../components/mini/changeData.php";
  }


  //----------------------------
require '../functions/getInfo.php';
if (isset($_POST['change_pass'])) {
  $showOptions = "../components/mini/changePass.php";
  if (!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['con-new_password'])) {
      if (!password_verify($_POST['old_password'], $password)) {
          $verifyOldPass = false;
      } else {
          // Check if the new password and confirmation match
          if ($_POST['new_password'] == $_POST['con-new_password']) {
              $newpass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
              
              $connectDB->changePassword($newpass, $userID);
              $success= true;
          } else {
              $verifyNewPass = false;
          }
      }
  } else {
      $verifyOldPass = false;
  }
}
if (isset($_POST['change_data'])) {
  $showOptions = "../components/mini/changeData.php";
  $dob = !empty($_POST['dob']) ? trim($_POST['dob']) : '';
  $gender = !empty($_POST['gender']) ? trim($_POST['gender']) : '';
  $collegeID = !empty($_POST['college']) ? trim($_POST['college']) : '';
  
  if($dob && $gender && $collegeID){
    $connectDB->ChangeData($userID, $dob, $gender, $collegeID);
    $successData = true;
  }
}



}



?>



<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../styles/index.css">
  <link rel="stylesheet" href="../styles/layout.css">
  <link rel="stylesheet" href="../styles/homepage.css">
  <link rel="stylesheet" href="../styles/accountSettings.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<body>
  <div class="flex-container">
    <div class = "main-container">
      <main>
      <div class="edit-profile-picture">
          <form action = "../functions/upload.php" id="imageForm" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <i class="fa-regular fa-pen-to-square fa-xl" style="color: #ffffff;"></i>
            <button type="submit" name="upload" id="saveButton" style="display:none;">Save</button>
            <div>
             <?php if (isset($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>
            </div>
            <p id="errorMessage" style="color:red; display:none;"></p>
          </form>
          </div>
      <form method="POST">
        <div class = "options-div" style="margin-top: 25px;">
          <div class="profile-picture">
          <img id="imagePreview" alt="Profile Picture Preview">
            <img src="../images/<?php echo $profile_picture?>">
            
          </div>
          
          <div class="profile-name">
              <a href="../pages/userpage.php"><h2><?php echo $username?></h2></a>
          </div>
          <br>
          <button class="option Login" name="changePass">Change Password</button>
          <button class="option Register" name="changeData">Change User Details</button>
        </div>
      </form>
      
      <div>
        <?php require $showOptions?>
      </div>
      </main>
      <aside>
        <div class="flex-aside">
          <?php require "../components/settingsAside.php"?>
        </div>  
      </aside>
    </div>
  </div>
  <script src='../functions/image_process.js'></script>
</body>



</html>