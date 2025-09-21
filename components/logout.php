<?php
session_start();
setcookie('email', "", time() +  60); // Secure and HttpOnly flags
setcookie('user_id', "", time() + 60);
session_destroy();

header("Location: ../index.php");
exit(0);
?>