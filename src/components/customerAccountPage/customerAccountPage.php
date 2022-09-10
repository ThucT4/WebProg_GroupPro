<?php session_start(); ?>
<?php
include_once('../../../server/write2file.php');
include_once('../../../server/readFromfile.php');
include_once('../../../server/classes/account.php');
$accountList = readFromFile("accounts.txt");

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
    <?php

    // foreach ($accountList as $account) {
    //     if ($_SESSION['user']) {
    //         if ($_SESSION['user'] == $account->username) {
    //             print_r($account);
    //             echo "<br>";
    //         }
    //     }
    // }


    if (isset($_POST['userName']) && isset($_POST['userAddress'])) {
        // echo $_POST['userName'];
        // echo $_POST['userAddress'];

        foreach ($accountList as $account) {
            if ($_SESSION['user']) {
                if ($_SESSION['user'] == $account->username) {
                    if ($account->type == 'customer') {
                        if (empty($_POST['userName'])) {
                            $arraynew = array("address"=>$_POST['userAddress']);
                        }
                        elseif (empty($_POST['userAddress'])) {
                            $arraynew = array("username" => $_POST['userName']);
                        }
                        else {
                            $arraynew = array("username" => $_POST['userName'], "address"=>$_POST['userAddress']);
                        }                  
                        $result = array_replace((array)$account, $arraynew);
                        print_r($result);
                        echo "<br>";

                        $newresult = array($result);

                        $asd = array_replace($accountList, $newresult);
                        print_r($asd);
                    }
                    if ($account->type == 'vendor') {

                    }
                    if ($account->type == 'shipper') {

                    }
                }
            }
        }
    }
    ?>
    <?php
    foreach ($accountList as $account) {
        if ($_SESSION['user']) {
            if ($_SESSION['user'] == $account->username) {
                $avaimg = $account->avt;
                // $account->username = $_POST['username'];
            }
        }
    }

    ?>
    <?php #if($_SESSION['user'] == $account->username) :
    ?>
    <!-- <div></div> -->
    <?php #endif 
    ?>
    <style>
        <?php include '../../../src/assets/styles/customerAccountPage.css'; ?><?php include '../../../public/bootstrap/css/bootstrap.min.css'; ?>
    </style>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 card shadow p-3 mb-5 bg-body rounded d-flex flex-column align-items-center">
                    <form class="col-12" name="profile-pic" id="profile-pic" method="post" action="edit_profile.php">
                        <div class="col-12 position-relative rounded-circle">
                            <?php
                            //echo $avaimg;
                            echo '<img class="img-fluid text-center" name = "fileToUpload" alt="profile pic" id="photo" src=' . $avaimg . '>';
                            ?>
                            <div class="position-absolute image-upload bottom-0 end-0" style="width:40px; height:40px;">
                                <label for="file-input" style="width:40px; height:40px;">
                                    <img src="../../../public/img/camera.png" alt="change ava button" class="img-fluid">
                                </label>
                                <input class="d-none" id="file-input" type="file" onchange="loadFile(event)">
                            </div>
                        </div>
                        <div class="col-12 profile-pic-btn">
                            <!-- <button type="button" class="btn btn-primary change-ava" onclick="refreshPage()">Confirm changes</button> -->
                            <button class="btn btn-primary" type="button">
                                <input type="submit" value="Confirm changes" id="submit-btn" />
                            </button>
                        </div>
                    </form>

                </div>
                <div class="col">
                    <div class="info d-flex ">
                        <div class="card shadow p-3 mb-5 bg-body rounded">
                            <h1>Name</h1>
                            <p>
                                <?php
                                echo $_SESSION['user'];
                                ?>
                            </p>
                        </div>

                        <?php
                        foreach ($accountList as $account) {
                            if ($_SESSION['user']) {
                                if ($_SESSION['user'] == $account->username) {
                                    if ($account->type == 'customer') {
                                        $html = '<div class="card shadow p-3 mb-5 bg-body rounded">';
                                        $html .= '<h1>Address</h1>';
                                        $html .= '<p>' . htmlspecialchars($account->address) . '</p>';
                                        $html .= '</div>';
                                        print_r($html);
                                    }
                                    if ($account->type == 'vendor') {
                                        $html = '<div class="card shadow p-3 mb-5 bg-body rounded">';
                                        $html .= '<h1>Business Name</h1>';
                                        $html .= '<p>' . htmlspecialchars($account->bussName) . '</p>';
                                        $html .= '</div>';
                                        $html .= '<div class="card shadow p-3 mb-5 bg-body rounded">';
                                        $html .= '<h1>Business Address</h1>';
                                        $html .= '<p>' . htmlspecialchars($account->bussAddress) . '</p>';
                                        $html .= '</div>';
                                        print_r($html);
                                    }
                                    if ($account->type == 'shipper') {
                                        $html = '<div class="card shadow p-3 mb-5 bg-body rounded">';
                                        $html .= '<h1>Hub</h1>';
                                        $html .= '<p>' . htmlspecialchars($account->hub) . '</p>';
                                        $html .= '</div>';

                                        print_r($html);
                                    }
                                }
                            }
                        }
                        ?>

                        <div class="button-container position-relative">
                            <button id="edit-btn" class="btn btn-primary position-absolute top-0 start-50 translate-middle" data-bs-toggle="modal" data-bs-target="#ChangeInfoModal">
                                <img src="../../../public/img/edit.png" alt="edit-info">
                                <div>&nbsp;&nbsp;Edit my profile</div>
                            </button>
                            <form method="post">
                            <?php
                            foreach ($accountList as $account) {
                                if ($_SESSION['user']) {
                                    if ($_SESSION['user'] == $account->username) {
                                        if ($account->type == 'customer') {
                                            echo
                                            <<<CODE
                                                    <div class="modal fade" id="ChangeInfoModal" tabindex="-1" aria-labelledby="ChangeInfoModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="ChangeInfoModalLabel">Change profile information</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Name</label>
                                                                        <input name="userName" type="text" class="form-control" id="name" aria-describedby="emailHelp">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="address" class="form-label">Address</label>
                                                                        <input name="userAddress" type="text" class="form-control" id="address">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            CODE;
                                        }
                                        if ($account->type == 'vendor') {
                                            echo
                                            <<<CODE
                                                    <div class="modal fade" id="ChangeInfoModal" tabindex="-1" aria-labelledby="ChangeInfoModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="ChangeInfoModalLabel">Change profile information</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Name</label>
                                                                        <input name="userName" type="text" class="form-control" id="name" aria-describedby="emailHelp">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="b_name" class="form-label">Business Name</label>
                                                                        <input name="business" type="text" class="form-control" id="b_name">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="b_address" class="form-label">Business Address</label>
                                                                        <input name="address" type="text" class="form-control" id="b_address">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            CODE;
                                        }
                                        if ($account->type == 'shipper') {
                                            echo
                                            <<<CODE
                                                    <div class="modal fade" id="ChangeInfoModal" tabindex="-1" aria-labelledby="ChangeInfoModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="ChangeInfoModalLabel">Change profile information</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Name</label>
                                                                        <input name="userName" type="text" class="form-control" id="name" aria-describedby="emailHelp">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label me-4" for="distribution-hub">Distribution Hubs</label>
                                                                        <select name="distribution-hub" id="distribution-hub">
                                                                            <option value="1">Hub Tân Phú</option>
                                                                            <option value="2">Hub Binh Chanh</option>
                                                                            <option value="3">LEX HUB HTB</option>
                                                                            <option value="4">Hub Quận 5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            CODE;
                                        }
                                    }
                                }
                            }
                            ?>
                            </form>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</html>