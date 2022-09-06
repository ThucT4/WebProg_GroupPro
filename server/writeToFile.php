<?php

function writeToFile($obj, $path, $permission)
{
    $objData = serialize($obj);
    $filePath = $_SERVER["DOCUMENT_ROOT"] . "/server/{$path}";
    if (is_writable($filePath)) {
        $file = fopen($filePath, $permission);
        fwrite($file, $objData);
        fwrite($file, "\n");
        fclose($file);
    }
}

function changeConfirmStatus($orderList)
{
    $filePath = $_SERVER["DOCUMENT_ROOT"] . "/server/order.txt";
    $fp = fopen($filePath, "w");
    fclose($fp);
    echo sizeof($orderList);
    foreach ($orderList as $orderItem) {
        if (!empty($orderItem)) {
            writeToFile($orderItem, "order.txt", "a");
        }
    }
}
