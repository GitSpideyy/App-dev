<?php


// Check if user is not logged in
if (!isset($_SESSION['userid'])) {
    // Destroy the session
    session_destroy();
    // Redirect to login page
    header('Location: login.php');
    exit();
}
?>
