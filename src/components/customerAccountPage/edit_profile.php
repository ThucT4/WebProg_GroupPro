<?php
    echo "Edit Profile php";
    if(isset($_POST['submit']) && !empty($_FILES["fileToUpload"]["name"])) {
        $timestamp = time();
        $target = "../../../server/database/userAvatar"; 
        $target = $target . basename($_FILES['uploaded']['name']) ; 
        echo $target;
    }
    elseif (empty($_FILES["fileToUpload"]["name"])){
        echo "Cant get img or img is empty";
    }
    
    echo $_POST('name');
?>