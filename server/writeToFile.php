<?php
function writeToFile($obj, $path)
{
    $objData = serialize($obj);
    $filePath = getcwd() . DIRECTORY_SEPARATOR . "{$path}";
    if (is_writable($filePath)) {
        $file = fopen($filePath, "a");
        fwrite($file, $objData);
        fwrite($file, "\n");
        fclose($file);
    }
}