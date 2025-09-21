<div class="form1" id="changePassForm">
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <input type="password" name="old_password" placeholder="Old Password" style="width:30vw" id="old_pass">
    <input type="password" name="new_password" placeholder="New Password" style="width:30vw" id="new_pass">
    <input type="password" name="con-new_password" placeholder="Confirm New Password" style="width:30vw">
    <button type="submit" class="submit" name="image">Submit</button>
    
    
    <?php 

      if ($verifyNewPass === false) {
        echo "Wrong confirm new password.";
      } elseif ($verifyOldPass === false) {
        echo "Wrong old password.";
      } elseif($success === true){
        echo "Change password Success!";
      }
    ?>
  </form>
  
</div>