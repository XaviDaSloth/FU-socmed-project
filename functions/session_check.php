<?php

session_start();

if (isset($_SESSION['is_logged_in'])) {

    if ($_SESSION['is_logged_in'] === false) {

        header('Location: ../index.php');
        exit(0);
    }

} else {

    header('Location: ../index.php');
    exit(0);

}

?>