<?php

function writeToFile($obj, $path, $permission)
{
    $objData = serialize($obj);
    $filePath = getcwd() . DIRECTORY_SEPARATOR . "{$path}";
    if (is_writable($filePath)) {
        $file = fopen($filePath, $permission);
        fwrite($file, $objData);
        fwrite($file, "\n");
        fclose($file);
    }
}

function changeConfirmStatus($orderList)
{
    $filePath = getcwd() . DIRECTORY_SEPARATOR . "order.txt";
    $fp = fopen($filePath, "w");
    fclose($fp);
    foreach ($orderList as $orderItem) {
        writeToFile($orderItem, "order.txt", "a");
    }
}
