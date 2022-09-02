<?php
session_start();

include_once('../../../server/readFromfile.php');
include_once('../../../server/classes/account.php');

global $accounts, $type, $username;
$accounts = readFromFile('accounts.txt');

if (isset($_POST['login'])) {
    //print_r($_POST);
    if (!authenticate($_POST)) {
        echo "<script type='text/javascript'> alert('Username or password is incorrect. PLease check again!');</script>";
    } else {
        setcookie('user', $GLOBALS['username'], time() + 3600);

        if ($GLOBALS['type'] === 'customer') {
            header('location: ../mainPage/mainPage.php');
        } else if ($GLOBALS['type'] == "vendor") {
            //header('location: ../vendorPage/vendor.php');
        } else {
            //header('location: ../shipperPage/shipper.php');
        }
    }
}

loadPage();

function loadPage()
{
    //Header
    require_once("../../../src/components/header/header.html");

    //Main
    require_once("../../../src/components/loginPage/loginPage.html");

    //Footer
    //require_once("../../../src/components/footer/footer.html");
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
