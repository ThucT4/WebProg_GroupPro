<?php
session_start();
function logOut()
{
    session_destroy();
    header("location: ../src/components/loginPage/login.php");
}
logOut();
