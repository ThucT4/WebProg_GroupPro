<?php
$target_dir = "../../../public/img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  }
  else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif") {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}
else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
  }
  else {
    echo "Sorry, there was an error uploading your file.";
  }
}

if (isset($_POST['p_name'])) {
  $line = '';
  $f = fopen('../../../server/product.txt', 'a+');
  $cursor = -1;
  fseek($f, $cursor, SEEK_END);
  $char = fgetc($f);
  //Trim trailing newline characters in the file
  while ($char === "\n" || $char === "\r") {
    fseek($f, $cursor--, SEEK_END);
    $char = fgetc($f);
  }
  //Read until the next line of the file begins or the first newline char
  while ($char !== false && $char !== "\n" && $char !== "\r") {
    //Prepend the new character
    $line = $char . $line;
    fseek($f, $cursor--, SEEK_END);
    $char = fgetc($f);
  }
  $line;
  $last_id = explode(":", $line);
  $new_id = intval($last_id[0]) + 1;
  $data = $new_id . ':' . $_FILES["fileToUpload"]["name"] . ':' . $_POST['p_stock'] . ':' . $_POST['p_name'] . ':' . $_POST['p_price'] . ':' . $_POST['p_description'] . PHP_EOL;
  fwrite($f, $data);
  fclose($f);
  header('Location: vendorPage-addproduct.php');
}
