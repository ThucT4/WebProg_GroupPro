<?php
session_status();
require_once('../../../server/readFromFile.php');
require_once('../../../server/write2file.php');
//change location
$target_dir = "../../../server/database/productImages/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$vendorName = $_SESSION['user'];

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "<script type='text/javascript'>alert('Sorry, image file already exists.');</script>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "<script type='text/javascript'>alert('Sorry, your image file is too large.');</script>";
  $uploadOk = 0;
}

// Allow certain file formats
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" && $imageFileType != "webp"
) {
  echo "<script type='text/javascript'>alert('Sorry, only JPG, JPEG, PNG, WEBP & GIF files are allowed.');</script>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<script type='text/javascript'>alert('Sorry, your file was not uploaded.');</script>";

  // if everything is ok, try to upload file
} else {
  global $username;
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $productList = readFromFile("product.txt");
    $getlastid = (array)end($productList);
    $array = array(
      'vendorName' => $username,
      'productID' => $getlastid['productID'] + 1,
      'productName' => $_POST['p_name'],
      'img' => '../../../server/database/productImages/' . $_FILES["fileToUpload"]["name"],
      'productDes' => $_POST['p_description'],
      'category' => $_POST['p_category'],
      'unitPrice' => $_POST['p_price'] . '$',
      'amount' => $_POST['p_stock'],
      'status' => 'In Stock'
    );
    writeToFile((object)$array, '/product.txt');
    echo "<script type='text/javascript'>alert('The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.');</script>";
    echo "<script type='text/javascript'>alert('The file " . $username . " has been uploaded.');</script>";
  } else {
    echo "<script type='text/javascript'>alert('Sorry, there was an error uploading your file.');</script>";
  }
}
?>
<script>
  var timer = setTimeout(function() {
    window.location = 'vendorPage-addproduct.php'
  }, 0);
</script>