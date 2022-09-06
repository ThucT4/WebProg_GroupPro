<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo "Please Login again";
    echo "<a href='http://localhost/somefolder/login.php'>Click Here to Login</a>";
}
else {
    $now = time(); // Checking the time now when home page starts.

    if ($_SESSION['accountType'] !== 'customer') {

    } 
    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "Your session has expired! <a href='http://localhost/somefolder/login.php'>Login here</a>";
    }
    else {
        require_once("../../../src/components/customerPage/customerPage.html");
    }
}
//echo $_SESSION['user']."<br>";
?>
