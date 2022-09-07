<<<<<<< HEAD
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
=======
<?php
function writeToFile($obj, $path)
{

    $objData = serialize($obj);
    $filePath = '../../../server/'. DIRECTORY_SEPARATOR . "{$path}";
    
    if (is_writable($filePath)) {
        //echo "writable"."<br>";
        $file = fopen($filePath, "a");
        fwrite($file, $objData);
        fwrite($file, "\n");
        fclose($file);
    }
    else {
        echo "Cant write to file"."<br>";
    }
}
>>>>>>> 0d31ffaba11dad559d964e0a977e5e39e1ad564c

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
