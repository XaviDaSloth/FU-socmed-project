<?php
session_start();

require "functions/database.php";
$displayForm = "login"; // Default form to display
$errormsg= "";
$con_database = new Database('localhost','root', '', 'finals');

if(isset($_COOKIE['username'])){
  $_SESSION['user_id'] = $_COOKIE['username'];
  header("Location: pages/homepage.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['loginOpt'])){
    $displayForm = "login";
  }elseif(isset($_POST['registerOpt'])){
    $displayForm = "register";
  }



  if (isset($_POST['login_submit'])) {
    $displayForm = "login";
    
    // Check if email and password are provided
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Sanitize inputs
        $username = trim($_POST['username']);
        $user_pass = trim($_POST['password']);
        
        // Attempt to log in
        $loginResult = $con_database->loginUser ($username, $user_pass);
        
        if ($loginResult === true) {
            $userID = $con_database->getUserID($username);
            // Successful login
            if (isset($_POST['remember']) && $_POST['remember'] === '1') {
                // Set cookie for "remember me" functionality
                setcookie('username', $username, time() + 7 * 24 * 60 * 60); // Secure and HttpOnly flags
                setcookie('user_id', $user_id, time() + 7 *24* 60*60);
            }
            $_SESSION['user_id'] = $userID;
            $_SESSION['is_logged_in'] = true;
            header("Location: pages/homepage.php");
            exit(0);
        } else {
            // Handle different error messages
            $errormsg = $loginResult; // Use the message returned from loginUser 
        }
    } else {
        $errormsg = "Please fill in both email and password.";
    }
}elseif(isset($_POST['register_submit'])){
    $displayForm = "register";
    $username = !empty($_POST['username']) ? trim($_POST['username']) : '';
    $fname = !empty($_POST['fname']) ? trim($_POST['fname']) : '';
    $lname = !empty($_POST['lname']) ? trim($_POST['lname']) : '';
    $dob = !empty($_POST['dob']) ? trim($_POST['dob']) : '';
    $gender = !empty($_POST['gender']) ? trim($_POST['gender']) : '';
    $fu_email = !empty($_POST['fu_email']) ? trim($_POST['fu_email']) : '';
    $school_id = !empty($_POST['school_id']) ? trim($_POST['school_id']) : '';
    $password = !empty($_POST['password']) ? $_POST['password'] : '';
    $con_password = !empty($_POST['con_password']) ? $_POST['con_password'] : '';
    $collegeID = !empty($_POST['college']) ? trim($_POST['college']) : '';

    if ($fname && $lname && $dob && $gender && $fu_email && $school_id && $password && $con_password && $collegeID) {
        if ($password !== $con_password) {
            $errormsg = "Passwords do not match.";
        } else {
            $hashedpassword = password_hash($password,  PASSWORD_DEFAULT);

            $result = $con_database->registerUser(
              $username,
              $fname,
              $lname,
              $dob,
              $gender,  
              $fu_email,
              $school_id,
              $hashedpassword,
              $collegeID
            ); 
          
          if ($result === true) {
            // Redirect to homepage on success
            header("Location: index.php");
            exit(); // Ensure no further script execution after redirect
          } else {
              // If the user registration failed, show the error message
              $errormsg = $result['message']; // Assuming `registerUser` returns a message with 'status' and 'message'
          }
        }
    } else {
        $errormsg = "Please fill out all fields.";
    }
  }

}


?>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/layout.css">
</head>
<body>
  <div class="flex-container">
    <div class = "main-container">
      <main>
        <?php 
        if(isset($displayForm)){
          if($displayForm == 'login'){
            require "components/loginForm.php";
          }else{
            require "components/registerForm.php";
          }
        }
        ?>
      </main>
      <aside>
        <div class="flex-aside">
          <div>
          <form method="POST">
            <div class = "options-div">
              <button class="option Login" name="loginOpt">Login</button>
              <button class="option Register" name="registerOpt">Register</button>
            </div>
            <div class = "logo-div">
              <img src="images/logo.png" alt="Greyhounds" class="logo-image">
            </div>
            </div>
          </form>
          <div class = "footer">
              All Rights Reserved 2024
          </div>
        </div>
      </aside>
    </div>
  </div>
</body>
</html>