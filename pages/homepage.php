<?php
require "../functions/database.php";
require "../functions/session_check.php";
$showAside = "../components/homePageAside.php";
if(isset($_GET['showSettings']) && $_GET['showSettings'] == true){
  $showAside = "../components/settingsAside.php";
}

  $userID = $_SESSION['user_id'];

$connectDB = new Database('localhost','root', '', 'finals');

require '../functions/getInfo.php';


if(isset($_GET['userID'])){
   $targetUserID = $_GET['userID']; // Assign the value from $_GET
}

if(isset($_POST['follow-user'])){
  $target = $_POST['targetUserID'];
  $connectDB->followUser($userID, $target);
}elseif(isset($_POST['unfollow-user'])){
  $target = $_POST['targetUserID'];
  $connectDB->unfollowUser($userID, $target);
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../styles/layout.css">
  <link rel="stylesheet" href="../styles/homepage.css">
  <link rel="stylesheet" href="../styles/user-post.css">
  <link rel="stylesheet" href="../styles/post-feed.css">
  <link rel="stylesheet" href="../styles/mn.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<script src="https://kit.fontawesome.com/ed66f4723e.js" crossorigin="anonymous"></script>

<body>
  <div class="flex-container">
    <div class = "main-container">
      <main>
      <?php require "../components/header.php";?>
        
        <div class ="flex-main">  
          <div class="user-post">
            <div class="user-post-name">
              <p><?php echo $username?></p>
              
            </div>
            <form action="" method="POST" class="user-post-form" id="postForm">
              <textarea id="user_post_content" name="content" class="user-text" placeholder="Write a Post..."></textarea>
              <div class="div-post-form">
                <input type="submit" name="user-post-submit" id="user-post-submit" class="user-post-submit">
              </div>
            </form>
          </div>
          <div id="posts">
          </div>
        </div>
      </main>

      <aside>
        <?php
        require $showAside;
        ?>

      </aside>
      
    </div>
  </div>

  <script src="../functions/jquery_ajax.js"></script> 
  
</body>

</html>