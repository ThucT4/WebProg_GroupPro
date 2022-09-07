<?php
// include_once('../../../server/write2file.php');
// include_once('../../../server/readFromfile.php');
// include_once('../../../server/classes/account.php');

// if (!isset($_SESSION['user'])) {
//     session_destroy();
//     echo "Please Login again";
//     echo "<a href='http://localhost/somefolder/login.php'>Click Here to Login</a>";    
// }
// else {
//     $now = time(); // Checking the time now when home page starts.

//     if ($now > $_SESSION['expire']) {
//         session_destroy();
//         echo "Your session has expired! <a href='http://localhost/somefolder/login.php'>Login here</a>";
//     }    
// }

// global $accounts,$username, $address;    
// $accounts = readFromFile('accounts.txt');
// $username = $_SESSION['user'];

// foreach ($GLOBALS['accounts'] as $account) {
//     if ($_SESSION['user'] === $account->username) {
//         $address = $account->address;               
//     }
// }

// function changeInfo(){ //function to change user info
//     foreach($accounts as $acc){
//         if ($acc->username == $username){ 
//             $temp = $acc;
//             unset($temp); //delete old data
//             $temp->address = $_POST['address']; //replace
//             $temp->username = $_POST['username'];
//             $temp_data = serialize($temp);
//             writeToFile($temp_data, "accounts.txt");
//         }
//     }        
// }

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
    <header>
        <?php
        require_once("../../../src/components/header/header.php");
        ?>
    </header>
    <style>
        <?php include '../../../src/assets/styles/customerAccountPage.css'; ?><?php include '../../../public/bootstrap/css/bootstrap.min.css'; ?>
    </style>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4 card shadow p-3 mb-5 bg-body rounded">
                    <form class="profile-pic-div" name="profile-pic" id="profile-pic" method="post" action="edit_profile.php">
                        <div class="image-upload">
                            <label for="file-input">
                                <img id="profile-pic-change" src="https://www.flaticon.com/svg/vstatic/svg/3917/3917361.svg?token=exp=1662458982~hmac=6cc1a0c422fbaf224e9a620d77da49d7" alt="change ava button" class="change-ava-btn form-control ">
                            </label>
                            <input id="file-input" type="file" onchange="loadFile(event)">
                        </div>
                        <img class="img-responsive img-fluid rounded-circle text-center" alt="profile pic" id="photo" src="https://img.freepik.com/free-vector/flat-design-lake-scenery_23-2149161405.jpg?w=2000">
                    </form>
                    <div class="profile-pic-btn">
                        <button type="button" class="btn btn-primary change-ava" onclick="refreshPage()">Confirm changes</button>
                    </div>

                </div>

                <div class="col">

                    <div class="info d-flex ">
                        <div class="card shadow p-3 mb-5 bg-body rounded">
                            <h1>Name</h1>
                            <p>Your name is
                                <?php echo $username; ?>
                            </p>
                        </div>

                        <div class="card shadow p-3 mb-5 bg-body rounded">
                            <h1>Address</h1>
                            <p>Your address is
                                <?php #echo $address; 
                                ?>
                            </p>
                        </div>

                        <div class="button-container position-relative">
                            <button type="submit" id="edit-btn" onclick="openForm()" class="btn btn-primary position-absolute top-0 start-50 translate-middle">
                                <img src="https://www.flaticon.com/svg/vstatic/svg/3917/3917361.svg?token=exp=1662458982~hmac=6cc1a0c422fbaf224e9a620d77da49d7" alt="edit-info">
                                <div>&nbsp;&nbsp;Edit my profile</div>
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

    <footer>
        <?php
        require_once("../../../src/components/footer/footer.html");
        ?>
    </footer>
</body>
<script src="/src/assets/scripts/customerAccountPage.js"></script>

</html>