<?php
require "../functions/database.php";
require "../functions/session_check.php"; 


$connectDB = new Database('localhost','root', '', 'finals');
$showAside = "../components/userPageAside.php";
if(isset($_GET['showSettings']) && $_GET['showSettings'] == true){
  $showAside = "../components/settingsAside.php";
}

$userID = $_SESSION['user_id'];

if(isset($_GET['userID'])){
  $targetUserID = $_GET['userID']; // Assign the value from $_GET
  $userID = $targetUserID;

}

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
  <input type="hidden" id="hiddenUserID" value="<?php echo ($userID); ?>">
  <div class="flex-container">
    <div class = "main-container">
      <main>
      <?php require "../components/header.php";?>
        <div class ="flex-main">  
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../functions/jquery_ajax_UserDP.js"></script>
</body>
</html>