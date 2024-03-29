<?php
session_start();
require_once('../../../server/readFromFile.php');
if (isset($_SESSION['user'])) {
  if ($_SESSION['accounttype'] != 'vendor') {
    echo <<<CODE
          <script type="text/javascript">
          window.location.href="../noPermission/noPermission.html";
      </script>
      CODE;
  }
}
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
</head>

<body>
  <header>
    <?php
    require_once("../../../src/components/header/header.php");
    ?>
  </header>
  <style>
    <?php include '../../../src/assets/styles/vendorPage.css'; ?><?php include '../../../public/bootstrap/css/bootstrap.min.css'; ?>
  </style>
  <main>
    <div class="d-flex flex-column m-2 p-4 border text-center" id="table_wrapper">
      <?php
      //   if (file_exists("../../../server/product.txt")) {
      //       echo "Found!";
      //   }
      //   else{
      //     echo "Not found!";
      // }
      $productList = readFromFile("product.txt");
      $html = '<table id="myproduct">';

      $html .= '<tr>';
      foreach ($productList[0] as $key => $value) {
        $html .= '<th>' . htmlspecialchars($key) . '</th>';
      }
      $html .= '</tr>';

      // data rows
      foreach ($productList as $key => $value) {
        if (array_values((array)$value)[0] == $_SESSION['user']) {
          $html .= '<tr>';
          foreach ($value as $key2 => $value2) {
            if (strpos($value2, "../../../") !== FALSE) {
              $html .= '<td><img id="p-img" src=\'' . $value2 . '\'></td>';
            } else {
              $html .= '<td>' . htmlspecialchars($value2) . '</td>';
            }
          }
          $html .= '</tr>';
        }
      }
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