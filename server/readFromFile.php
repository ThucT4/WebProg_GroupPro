<?php
function readFromFile($path)
{
    $filePath = getcwd() . DIRECTORY_SEPARATOR . "{$path}";
    if (file_exists($filePath)) {
        $objData = file_get_contents($filePath);
        $obj = unserialize($objData);
    }
    $objectList = [];
    if (file_exists($filePath)) {
        $file = fopen($filePath, "r");
        while (!feof($file)) {
            $line = fgets($file);
            $obj = unserialize($line);
            array_push($objectList, $obj);
        }
    }
    fclose($file);
    return $objectList;
}