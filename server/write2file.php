<<<<<<< HEAD
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
>>>>>>> cd856a08cdf8ccca1c8cf8c53086872c9e441c19
?>