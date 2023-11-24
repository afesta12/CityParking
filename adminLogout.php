<!-- Script for admin logout -->
<?php 

    session_start();

    // Clear session variables -> destroy session
    $_SESSION = array();
    session_destroy();

    // redirect to home
    header("Location: index.php");
    exit();
?>