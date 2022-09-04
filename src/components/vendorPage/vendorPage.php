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
    <!-- <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/src/assets/styles/vendorPage.css" /> -->
    <style>
      <?php include '../../../public/bootstrap/css/bootstrap.min.css'; ?>
      <?php include '../../../src/assets/styles/vendorPage.css'; ?>
    </style>
</head>
<p class="text-center">This is vendor page</p>

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
      // print_r($productList);
      // echo "<br>";
      // echo count($productList);
        // start table
        $html = '<table>';
        // header row
        $html .= '<tr>';
        foreach($productList[0] as $key=>$value){
                $html .= '<th>' . htmlspecialchars($key) . '</th>';
            }
        $html .= '</tr>';
    
        // data rows
        foreach( $productList as $key=>$value){
            $html .= '<tr>';
            foreach($value as $key2=>$value2){
                
                if (strpos($value2, "../../../") !== FALSE) {
                  //echo $value2.'<br>';
                  $logo = "data:image/jpg;base64,".base64_encode($value2);
                  //echo"<img src=\"$logo\">"; 
                  $html .= '<td><img id="p-img" src=\'' . $logo . ')\'></td>';
              }
              else {
                $html .= '<td>' . htmlspecialchars($value2) . '</td>';
              }
            }
            $html .= '</tr>';
        }
    
        // finish table and return it
    
        $html .= '</table>';
        print_r($html);
        
    ?>
        <!-- <a href="vendorPage-addproduct.php" class="d-flex flex-row-reverse p-2 " role="button" id="add-product-btn">
            <button class="btn btn-primary" type="button">Add Product</button>
        </a> -->
        <a href="vendorPage-addproduct.php" class="btn btn-primary text-center" role="button" id="add-product-btn">
          Add Product
        </a>
      </div>
    </main>
    
</body>
<footer>
      <?php 
        require_once("../../../src/components/footer/footer.html");
      ?>
    </footer>
<link rel="stylesheet" href="/src/assets/scripts/vendorPage.js" />

</html>