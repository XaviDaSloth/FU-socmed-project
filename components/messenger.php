<?php
$followerId = $_SESSION['user_id']; 
$followers = $connectDB->getFollowers($followerId); 
?>
<div class="mn-notification-container">
    <?php
    foreach ($followers as $follows) {
        echo "
        <div class='mn-messenger'>
            <div class='messenger-msg'>
                <div class='msg name'>
                    <h3>" . $follows['username'] . "</h3>
                </div>
                <form action='' method='POST' name='following_form'>
                    <input type='hidden' name='target_user_id' value='" . $follows['id'] . "'>
                    <button type='submit' name='follow' class='follow' value='" . $follows['id'] . "'>
                        Follow
                    </button>
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