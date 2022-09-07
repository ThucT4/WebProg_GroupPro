<?php
function writeToFile($obj, $path)
{

    $objData = serialize($obj);
    $filePath = '../../../server/database/db' . DIRECTORY_SEPARATOR . "{$path}";

    if (is_writable($filePath)) {
        //echo "writable"."<br>";
        $file = fopen($filePath, "a");
        fwrite($file, $objData);
        fwrite($file, "\n");
        fclose($file);
    } else {
        echo "Cant write to file" . "<br>";
    }
}
