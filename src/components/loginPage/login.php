<?php
session_start();

include_once($_SERVER["DOCUMENT_ROOT"] . '/server/readFromfile.php');
include_once($_SERVER["DOCUMENT_ROOT"] . '/server/classes/account.php');

global $accounts, $type, $username;
$accounts = readFromFile('accounts.txt');

if (isset($_SESSION['user'])) {
    echo $type;
    if ($_SESSION['accounttype'] == 'customer') {
        header('location: ../mainPage/mainPage.php');
    } else if ($_SESSION['accounttype'] == "vendor") {
        header('location: ../vendorPage/vendorPage.php');
    } else {
        header('location: ../shipperPage/shipperPage.php');
    }
}

if (isset($_POST['login'])) {
    if (!authenticate($_POST)) {
        echo "<script type='text/javascript'> alert('Username or password is incorrect. PLease check again!');</script>";
    } else {
        $_SESSION['start'] = time();
        $_SESSION['user'] = $GLOBALS['username'];
        $_SESSION['accounttype'] = $GLOBALS['type'];
        $_SESSION['expire'] = $_SESSION['start'] + (120 * 60); //Expire after 30m

        if ($_SESSION['accounttype'] == 'customer') {
            header('location: ../mainPage/mainPage.php');
        } else if ($_SESSION['accounttype'] == 'vendor') {
            header('location: ../vendorPage/vendorPage.php');
        } else {
            header('location: ../shipperPage/shipperPage.php');
        }
        unset($_POST['login']);
    }
}

loadPage();

function loadPage()
{

    require_once($_SERVER["DOCUMENT_ROOT"] . "/src/components/loginPage/loginPage.html");

    //Footer
    require_once("../../../src/components/footer/footer.html");
}


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
