<?php
session_start();

include_once('../../../server/write2file.php');
include_once('../../../server/readFromfile.php');
include_once('../../../server/classes/account.php');

if (!isset($_SESSION['user'])) {
    session_destroy();
    echo "Please Login again";
    echo "<a href='http://localhost/somefolder/login.php'>Click Here to Login</a>";    
}
else {
    $now = time(); // Checking the time now when home page starts.

    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "Your session has expired! <a href='http://localhost/somefolder/login.php'>Login here</a>";
    }    
}

global $accounts,$username, $address;    
$accounts = readFromFile('accounts.txt');
$username = $_SESSION['user'];

foreach ($GLOBALS['accounts'] as $account) {
    if ($_SESSION['user'] === $account->username) {
        $address = $account->address;               
    }
}
    
function changeInfo(){ //function to change user info
    foreach($accounts as $acc){
        if ($acc->username == $username){ 
            $temp = $acc;
            unset($temp); //delete old data
            $temp->address = $_POST['address']; //replace
            $temp->username = $_POST['username'];
            $temp_data = serialize($temp);
            writeToFile($temp_data, "accounts.txt");
        }
    }        
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Account Page</title>
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/src/assets/styles/customerAccountPage.css">
</head>

<body>
    <header include-one="../header/header.html"></header>
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-xs-12 col-sm-4">
                    <form class="profile-pic-div" name="profile-pic" id="profile-pic" method="post"
                        action="edit_profile.php">
                        <div class="image-upload">
                            <label for="file-input">
                                <img id="profile-pic"
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBQjQVne9Bl-9G4uf4Gk9oTr3WPLI8hpigUw&usqp=CAU"
                                    alt="change ava button" class="change-ava-btn form-control">
                            </label>
                            <input id="file-input" type="file" onchange="loadFile(event)">
                        </div>
                        <img class="img-responsive img-fluid rounded-circle text-center" alt="profile pic" id="photo"
                            src="https://img.freepik.com/free-vector/flat-design-lake-scenery_23-2149161405.jpg?w=2000">
                    </form>
                    <div class="profile-pic-btn">
                        <button type="button" class="btn change-ava" onclick="refreshPage()">Confirm changes</button>
                    </div>
                    
                </div>
    
                <div class="col">                    
    
                    <div class="info d-flex">
                        <h1>Name</h1>
                        <p>Your name is <?php echo $username;?></p>   
                            
                        <h1>Address</h1>
                        <p>Your address is <?php echo $address;?></p>  
                        
                        <div class="button-container text-center">
                            <button type="submit" id="edit-btn" onclick="openForm()">
                                <img class="edit-button" id="edit-profile"
                                src="data:image/png;base64,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"
                                alt="edit-info">
                            </button>              
                                                        
                            <div class="form-popup" id="myForm">
                                <form action="/action_page.php" class="form-container">
                                  <h1 style="color: #f98181;">Change profile information</h1>
                              
                                  <label for="name"><b>Name</b></label>
                                  <input type="text" id="name" placeholder="Edit Name" name="name" required>           
                                  
                                  <label for="address"><b>Address</b></label>
                                  <input type="text" id="address" placeholder="Edit Address" name="address" required>                
                                                
                                  <button type="submit" class="btn confirm" onclick="changeInfo()">Confirm</button>
                                  <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        
    </div>    

    <footer>This is a footer</footer>
</body>
<script src="/src/assets/scripts/customerAccountPage.js"></script>

</html>
