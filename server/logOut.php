<<<<<<< HEAD
<?php
    session_start();
    session_destroy();

    header("location: ../src/components/loginPage/login.php");
=======
<?php
    session_start();
    function logOut() {
        session_destroy();

        header("location: {$_SERVER["DOCUMENT_ROOT"]}/src/components/loginPage/login.php");
    }
>>>>>>> cd856a08cdf8ccca1c8cf8c53086872c9e441c19
?>