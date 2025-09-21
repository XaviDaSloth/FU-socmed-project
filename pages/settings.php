<?php

?>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../styles/index.css">
  <link rel="stylesheet" href="../styles/layout.css">
  <link rel="stylesheet" href="../styles/homepage.css">
  
</head>
<body>
  <div class="flex-container">
    <div class = "main-container">
      <main>
      <div class="form2">
          <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <input type="text" name="fu_email" placeholder="FU Email" style="width:30vw">
            <input type="password" name="password" placeholder="Password" style="width:30vw">
            <input type="checkbox" name="remember">
            <label for="checkbox" style="color:gainsboro;" value="1">Remember Me</label>
            <button type="submit" class="submit" name="login_submit" style="margin-top:1vh">Login</button>
          </form>
        </div>
      </main>
      <aside>
        <?php require "../components/settingsAside.php"?>
      </aside>
      
    </div>
  </div>
</body>
</html>