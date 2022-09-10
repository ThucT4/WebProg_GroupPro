<?php session_start(); ?>
<?php
include_once('../../../server/writeToFile.php');
include_once('../../../server/readFromfile.php');
include_once('../../../server/classes/account.php');
$accountList = readFromFile("accounts.txt");

foreach ($accountList as $account) {
    if ($_SESSION['user']) {
        if ($_SESSION['user'] == $account->username) {
            $avaimg = $account->avt;
        }
    }
}

if (isset($_FILES['avt-change-img']) && $_FILES['avt-change-img']['name'] != "") {
    if (file_exists("$avaimg")) {
        unlink($avaimg);
    }
    $newpath = explode("../../../server/database/userAvatar/", $avaimg)[1];
    $newpath = explode(".", $newpath)[0];
    $extension = explode(".", $_FILES['avt-change-img']['name'])[1];
    $new_location = "../../../server/database/userAvatar/{$newpath}.{$extension}";
    move_uploaded_file($_FILES['avt-change-img']['tmp_name'], $new_location);
    foreach ($accountList as $account) {
        if ($_SESSION['user']) {
            if ($_SESSION['user'] == $account->username) {
                $account->avt = $new_location;
                changeAccountInfo($accountList);
                break;
            }
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
    <header>
        <?php
        require_once("../../../src/components/header/header.php");
        ?>
    </header>
    <?php
    foreach ($accountList as $account) {
        if ($_SESSION['user']) {
            if ($_SESSION['user'] == $account->username) {
                $avaimg = $account->avt;
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($accountList as $account) {
            if ($_SESSION['user']) {
                if ($_SESSION['user'] == $account->username) {
                    if ($account->type == 'customer' && isset($_POST['userAddress'])) {
                        $account->address = $_POST['userAddress'];
                    }

                    if ($account->type == 'vendor' && isset($_POST['business']) && isset($_POST['address'])) {
                        $account->bussName = $_POST['business'];
                        $account->bussAddress = $_POST['address'];
                    }

                    if ($account->type == 'shipper' && isset($_POST['distribution-hub'])) {
                        $account->hub = $_POST['distribution-hub'];
                    }
                    changeAccountInfo($accountList);
                }
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
                    <form class="col-12" name="profile-pic" id="profile-pic" method="post" action="" enctype="multipart/form-data">
                        <div class="col-12 position-relative rounded-circle">

                            <img class="img-fluid text-center" name="fileToUpload" alt="profile pic" id="photo" src=' <?= $avaimg ?>'>
                            <div class="position-absolute image-upload bottom-0 end-0" style="width:40px; height:40px;">
                                <label for="file-input" style="width:40px; height:40px;">
                                    <img src="../../../public/img/camera.png" alt="change ava button" class="img-fluid" id="camera-btn">
                                </label>
                                <input name="avt-change-img" class="d-none" id="file-input" type="file" onchange="loadFile(event)">
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
                                                                        <label class="form-label me-4" for="distribution-hub">Distribution Hubs</label>
                                                                        <select name="distribution-hub" id="distribution-hub">
                                                                            <option value="Hub Tân Phú">Hub Tân Phú</option>
                                                                            <option value="Hub Binh Chanh">Hub Binh Chanh</option>
                                                                            <option value="LEX HUB HTB">LEX HUB HTB</option>
                                                                            <option value="Hub Quận 5">Hub Quận 5</option>
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