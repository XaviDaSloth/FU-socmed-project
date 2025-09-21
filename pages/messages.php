<?php

$showAside = "../components/homePageAside.php";
if(isset($_GET['showSettings']) && $_GET['showSettings'] == true){
  $showAside = "../components/settingsAside.php";
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../styles/layout.css">
  <link rel="stylesheet" href="../styles/homepage.css">
  <link rel="stylesheet" href="../styles/mn.css">
  <link rel="stylesheet" href="../styles/messenger.css">
</head>
<script src="https://kit.fontawesome.com/ed66f4723e.js" crossorigin="anonymous"></script>
<body>
  <div class="flex-container">
    <div class = "main-container">
      <main>
        <header>
        <div class="logo">
          <img src="../images/nav-logo.png" alt="" class="header-logo">
        </div>
        </header>
        <div class ="flex-main">  
          <div class="flex-message">
            <div class="message-top">
              JOHNNY XAVIER OBAR
            </div>
            <div class="in-messages" id="in-messages">
              <div class="msgs" id="msgs">
                <div class="user-side-bbl">
                  <div class="bbl-msgs bbl-user"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>
                </div>
                <div class="other-side-bbl">
                <div class="bbl-msgs bbl-other"><p>Lorem ipsum dolor sit amet</p></div>
                </div>
                <div class="user-side-bbl">
                  <div class="bbl-msgs bbl-user"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>
                </div>
                <div class="user-side-bbl">
                  <div class="bbl-msgs bbl-user"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>
                </div>
              </div>
            </div>
            <div class="flex-user-msg">
              <div>
                <i class="fa-solid fa-upload fa-2xl" style="color: 8B0101;"></i>
              </div>
              <div>
                <i class="fa-regular fa-image fa-2xl" style="color: 8B0101;"></i>
              </div>
              <div id="user-msg">
              <textarea placeholder="Type a message..."></textarea>
                <div id="send-msg">
                  <i class="fa-regular fa-paper-plane fa-2xl" style="color: 8B0101;"></i>
                </div>
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
</body>
</html>