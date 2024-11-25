<?php
    include_once "../init.php";

    // Perform the logout operation
    $getFromU->logout();

    // Redirect to index.php
    header("Location: ../index.php");
    exit(); // Ensure the script stops after the redirect
?>
