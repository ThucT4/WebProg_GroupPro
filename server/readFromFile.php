<?php
function readFromFile($path)
{
    $filePath = '../../../server/'. DIRECTORY_SEPARATOR . "{$path}";
    
    $objectList = array();
    if (file_exists($filePath)) {
        //echo "readding file"."<br>";
        $file = fopen($filePath, "r");

        while (!feof($file)) {
            $line = fgets($file);
            if ($line == "") {
                break;
            }
            $obj = unserialize($line);
            array_push($objectList, $obj);
        }
        fclose($file);
    }
    
    //echo count($objectList);
    //print_r($objectList);
    return $objectList;
}
?>