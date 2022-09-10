<?php
session_start();

include_once('../../../server/write2file.php');
include_once('../../../server/readFromfile.php');
include_once('../../../server/classes/account.php');
include_once('../../../server/classes/distributionHub.php');

global $accounts, $hubs;
$accounts = readFromFile('accounts.txt');
$hubs = readFromFile('distributionHubs.txt');

if (isset($_POST['create-account'])) {
    $result = validate($_POST);

    if ($result == 1) {
        echo "<script type='text/javascript'> alert('Username has been used. PLease use another username!');</script>";
    } else if ($result == 2) {
        echo "<script type='text/javascript'> alert('Bussiness name or Bussiness address has been used. PLease use another one!');</script>";
    } else {
        $order = count($GLOBALS['accounts']) + 1;

        $new_location = "";

        if (isset($_FILES['avt']) && $_FILES['avt']['name'] != "") {
            $extension = explode(".", $_FILES['avt']['name'])[1];

            $new_location = "../../../server/database/userAvatar/avatar{$order}.{$extension}";
            move_uploaded_file($_FILES['avt']['tmp_name'], $new_location);
        }

        $temp = new Account(
            $_POST['username'],
            password_hash($_POST['password'], PASSWORD_DEFAULT),
            $new_location,
            $_POST['account-type'],
            $_POST['address'],
            $_POST['buss-name'],
            $_POST['buss-address'],
            $_POST['distribution-hub']
        );

        writeToFile($temp, "accounts.txt");

        header('location: ../loginPage/login.php');
    }
}

loadPage();

function loadPage()
{   //Main
    require_once("../../../src/components/registerPage/registerPage.html");

    foreach ($GLOBALS['hubs'] as $hub) {
        $name = $hub->name;

        echo "<script type=\"text/JavaScript\">
            var node = document.querySelector(\"select#distribution-hub\");

            option = document.createElement('option');
            option.value = '{$name}';
            option.innerHTML = '{$name}';

            node.appendChild(option);
            </script>";
    }

    //Footer
    require_once("../../../src/components/footer/footer.html");
}

function validate($input)
{
    foreach ($GLOBALS['accounts'] as $account) {
        if ($input['username'] === $account->username) {
            return 1;
        }
        if ($input['account-type'] === "vendor" && $account->type === "vendor") {
            if ($input['buss-name'] === $account->bussName || $input['buss-address'] === $account->bussAddress) {
                return 2;
            }
        }
    }
    return 0;
}
