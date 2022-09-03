<?php
session_start();

include_once('../../../server/write2file.php');
include_once('../../../server/readFromfile.php');
include_once('../../../server/classes/account.php');

global $accounts;
$accounts = readFromFile('accounts.txt');

if (isset($_POST['create-account'])) {
    if (!validate($_POST)) {
        echo "<script type='text/javascript'> alert('Username has been used. PLease use another username!');</script>";
    } else {
        $order = count($GLOBALS['accounts']) + 1;

        $extension = explode(".", $_FILES['avt']['name'])[1];

        $new_location = "../../../server/database/userAvatar/avatar{$order}.{$extension}";
        move_uploaded_file($_FILES['avt']['tmp_name'], $new_location);

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
{
    //Header
    // require_once("../../../src/components/header/header.php");

    //Main
    require_once("../../../src/components/registerPage/registerPage.html");

    //Footer
    //require_once("../../../src/components/footer/footer.html");
}

function validate($input)
{
    foreach ($GLOBALS['accounts'] as $account) {
        if ($input['username'] === $account->username) {
            return false;
        }
    }
    return true;
}
