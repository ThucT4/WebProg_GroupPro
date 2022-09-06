<?php
require_once('../../../server/readFromFile.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/src/assets/styles/vendorPage.css" />
  <style>
    <?php include '../../../src/assets/styles/vendorPage.css'; ?>
  </style>
</head>

<body>
  <header>
    <?php
    require_once("../../../src/components/header/header.php");
    ?>
  </header>
  <main>
    <div class="d-flex flex-column m-2 p-4 border text-center">
      <?php
      //   if (file_exists("../../../server/product.txt")) {
      //       echo "Found!";
      //   }
      //   else{
      //     echo "Not found!";
      // }
      $productList = readFromFile("product.txt");
      $html = '<table id="myproduct">';
      // header row
      $html .= '<tr>';
      foreach ($productList[0] as $key => $value) {
        $html .= '<th>' . htmlspecialchars($key) . '</th>';
      }
      $html .= '</tr>';

      //check user


      // data rows
      foreach ($productList as $key => $value) {
        //var_dump($value);
        //echo array_values((array)$value)[0];
        if (array_values((array)$value)[0] == $_SESSION['user']) {
          //echo array_values((array)$value)[0] . " == " . $_SESSION['user'];
          $html .= '<tr>';
          foreach ($value as $key2 => $value2) {
            if (strpos($value2, "../../../") !== FALSE) {
              //echo $value2.'<br>';
              $logo = "data:image/jpg;base64," . base64_encode($value2);
              //echo $value2;
              $html .= '<td><img id="p-img" src=\'' . $value2 . ')\'></td>';
            } else {
              $html .= '<td>' . htmlspecialchars($value2) . '</td>';
            }
          }
          $html .= '</tr>';
        }
      }

      // finish table and return it

      $html .= '</table>';
      print_r($html);
      ?>
      <a href="vendorPage-addproduct.php" class="btn btn-primary text-center" role="button" id="add-product-btn">
        Add Product
      </a>
    </div>
  </main>

  <script>
    headerRow = document.querySelector('table.myproduct tbody tr');
    headerRow.style.backgroundColor = "red";
  </script>

</body>
<footer>
  <?php
  require_once("../../../src/components/footer/footer.html");
  ?>
</footer>
<link rel="stylesheet" href="/src/assets/scripts/vendorPage.js" />

</html>