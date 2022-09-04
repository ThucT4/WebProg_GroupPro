<?php
session_start();

include_once('../../../server/readFromfile.php');
include_once('../../../server/classes/account.php');

global $accounts, $type, $username;
$accounts = readFromFile('accounts.txt');

//unset($_SESSION['user']);
//unset($_SESSION['accountType']);
if (isset($_SESSION['user'])) {
    echo $type;
    header('location: ../customerPage/customerPage.php');
    if ($_SESSION['accountType'] === 'customer') {
        header('location: ../customerPage/customerPage.php');
    } else if ($_SESSION['accountType'] === "vendor") {
        header('location: ../vendorPage/vendor.php');
    } else {
        header('location: ../shipperPage/shipper.php');
    }
}

if (isset($_POST['login'])) {
    //print_r($_POST);
    if (!authenticate($_POST)) {
        echo "<script type='text/javascript'> alert('Username or password is incorrect. PLease check again!');</script>";
    } else {
        $_SESSION['start'] = time();
        $_SESSION['user'] = $GLOBALS['username'];
        $_SESSION['accounttype'] = $GLOBALS['type'];
        $_SESSION['expire'] = $_SESSION['start'] + (120 * 60); //Expire after 30m


        if ($_SESSION['accountType'] == 'customer') {
            header('location: ../mainPage/mainPage.php');
        } else {
            header('location: ../mainPage/mainPage.php');
        }
        unset($_POST['login']);
    }
}

loadPage();

function loadPage()
{
    //Header
    // require_once("../../../src/components/header/header.php");

    //Main
    require_once("../../../src/components/loginPage/loginPage.html");

    //Footer
    // require_once("../../../src/components/footer/footer.html");
}

//print_r($_POST)."<br>";

function authenticate($input)
{
    foreach ($GLOBALS['accounts'] as $account) {
        if ($input['username'] === $account->username) {
            $GLOBALS['type'] = $account->type;
            $GLOBALS['username'] = $account->username;
            return password_verify($input['password'], $account->password);
        }
    }
    return false;
}
