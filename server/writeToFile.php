<?php

function writeToFile($obj, $path, $permission)
{
    $objData = serialize($obj);
    $filePath = $_SERVER["DOCUMENT_ROOT"] . "/server/database/db/{$path}";
    if (is_writable($filePath)) {
        $file = fopen($filePath, $permission);
        fwrite($file, $objData);
        fwrite($file, "\n");
        fclose($file);
    }
}

function changeConfirmStatus($orderList)
{
    $filePath = $_SERVER["DOCUMENT_ROOT"] . "/server/database/db/order.txt";
    $fp = fopen($filePath, "w");
    fclose($fp);
    foreach ($orderList as $orderItem) {
        if (!empty($orderItem)) {
            writeToFile($orderItem, "order.txt", "a");
        }
    }
}

function changeAccountInfo($accountList)
{
    $filePath = $_SERVER["DOCUMENT_ROOT"] . "/server/database/db/accounts.txt";
    $fp = fopen($filePath, "w");
    fclose($fp);
    foreach ($accountList as $accountItem) {
        if (!empty($accountItem)) {
            writeToFile($accountItem, "accounts.txt", "a");
        }
    }
}