<?php
session_start();
function logOut()
{
    session_destroy();
    header("location: ../src/components/loginPage/login.php");
}
logOut();

?>
<script type="text/javascript">
    localStorage.clear();
</script>