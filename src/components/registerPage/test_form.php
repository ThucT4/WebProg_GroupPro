<?php
session_start();

include_once('../../../server/write2file.php');
include_once('../../../server/readFromfile.php');
include_once('../../../server/classes/distributionHub.php');

global $accounts;
    $accounts = readFromFile('distributionHubs.txt');

    /*if (isset($_POST['create-account'])) {
        //print_r($_POST);
        if (!validate($_POST)) {
            //$_SESSION['error'] = 1;
            //header('location: register.php');
        }
        else {
            
        }

        
    }*/
    //$temp = new DistributionHub("Hub Quận 5", "1610 Đ. Võ Văn Kiệt, Phường 7, Quận 6, Thành phố Hồ Chí Minh");

    //writeToFile($temp, "distributionHubs.txt");

    foreach ($GLOBALS['accounts'] as $account) {
        print_r($account->name);
    }

    function validate($input) {
        foreach ($GLOBALS['accounts'] as $account) {
            if ($input['username'] === $account->username) {
                return false;
            }
        }
        return true;
    }
?>