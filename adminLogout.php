<?php 

    session_start();

    // Clear session variables -> destroy session
    $_SESSION = array();
    session_destroy();

    // redirect
    header("Location: index.php");
    exit();
?>