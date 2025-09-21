<?php
$userID = $_SESSION['user_id'];
$following = $connectDB->getFollowing($userID);
?>
<div class="mn-messenger-container">
  <?php
  foreach ($following as $follows) {
      echo "
      <div class='mn-messenger'>
        <div class='messenger-msg'>
          <div class='msg name'><h3>" . $follows['username'] . "</h3></div>
          <form action='' method='post' name='following_form'>
            <input type='hidden' name='target_user_id' value='" . $follows['id'] . "'>
            <button type='submit' name='unfollow' class='follow' value='" . $follows['id'] . "'>
              Unfollow
            </button>
          </form>
        </div>
      </div>
      ";
  }
  ?>
</div>
