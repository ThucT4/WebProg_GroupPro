<?php
    session_start();
    session_destroy();

    header("location: ../src/components/loginPage/login.php");
?>