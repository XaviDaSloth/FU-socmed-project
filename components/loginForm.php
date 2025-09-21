<?php 
  
?>

<div class="form2">
  <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <input type="text" name="username" placeholder="Username" style="width:30vw">
    <input type="password" name="password" placeholder="Password" style="width:30vw">
    <input type="checkbox" name="remember" value=1>
    <label for="checkbox" style="color:gainsboro; display:inline;" value="1">Remember Me</label>
    <button type="submit" class="submit" name="login_submit" style="margin-top:1vh">Login</button>
    <div style="color:white;"><?php echo $errormsg; ?></div>
  </form>
  
</div>