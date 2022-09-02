<?php
    session_start();
    function logOut() {
        session_destroy();

        header("location: {$_SERVER["DOCUMENT_ROOT"]}/src/components/loginPage/login.php");
    }
?>