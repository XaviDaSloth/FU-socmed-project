<?php



?>
<div class="form1" id="changePassForm">
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <input type="password" name="old_password" placeholder="Old Password" style="width:30vw" id="old_pass">
    <input type="password" name="new_password" placeholder="New Password" style="width:30vw" id="new_pass">
    <input type="password" name="con-new_password" placeholder="Confirm New Password" style="width:30vw">
    <button type="submit" class="submit" name="change_pass">Submit</button>
    
    
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
<!-- 
<script>
        // Select the form element
        const form = document.getElementById('changePassForm');

        // Add an event listener for form submission
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from refreshing the page

            // Perform any desired actions here
            const old_password = document.getElementById('old_pass').value;
            const new_password = document.getElementById('new_pass').value;

            console.log('Username:', old_password);
            console.log('Email:', new_password);

        });
    </script> -->