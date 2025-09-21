<?php
require "../functions/database.php";
require "../functions/session_check.php"; 


$connectDB = new Database('localhost','root', '', 'finals');
$showAside = "../components/userPageAside.php";
if(isset($_GET['showSettings']) && $_GET['showSettings'] == true){
  $showAside = "../components/settingsAside.php";
}

$userID = $_SESSION['user_id'];

require "../functions/getInfo.php";
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
  <link rel="stylesheet" href="../styles/userPage.css">
</head>
<script src="https://kit.fontawesome.com/ed66f4723e.js" crossorigin="anonymous"></script>
<body>

  <div class="flex-container">
    <div class = "main-container">
      <main>
      <?php require "../components/header.php";?>
        <div class ="flex-main">  
          <div id="posts">
              <div class="flex-posts">
                <div class="div-posts-name">
                  <img src= '../images/<?php echo $profile_picture?>' class='post-image'>
                  <h3><?php echo $username?></h3>
                  <p id="follow">Follow</p>
                  <i class="fa-solid fa-ellipsis-vertical fa-lg"></i>
                  <span class="separator"></span>
                </div>
                <div class="div-posts-content">
                  CONTENT
                </div>
                <div class="div-posts-reactions">
                  <div><i class="fa-regular fa-thumbs-up fa-xl"></i><p>20</p></div>
                </div>
              </div>
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

<script src="../functions/jquery_ajax_UserDP.js"></script>
</body>
</html>