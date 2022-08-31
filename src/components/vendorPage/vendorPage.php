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
      <?php include '../../../public/bootstrap/css/bootstrap.min.css'; ?>'
      <?php include '../../../src/assets/styles/vendorPage.css'; ?>
    </style>
</head>
<p class="text-center">This is vendor page</p>

<body>
    <header>
      <?php 
        require_once("../../../src/components/header/header.html");
      ?>
    </header>

    <main>
      <div class="d-flex flex-column m-2 p-4 border text-center">
      <?php
        if (file_exists("../../../server/product.txt")) {
            echo "Found!";
        }
        else{
          echo "Not found!";
      }
      // $fp = fopen("../../../server/product.txt", "r");

      // if (!$fp) {
      //     echo "File cannot be opened";
      //     exit;
      // }
      
      $row = 1;

      if (($handle = fopen("../../../server/product.txt", "r")) !== FALSE) {
        echo '<table class="table" id="product-table">'; // open table
        // render headers
        echo '<thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Product Image</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Price</th>
                  <th scope="col">Description</th>
              </tr>
              </thead>
              <tbody>';
        while (($data = fgetcsv($handle, 1000, ":")) !== FALSE) {
          $num = count($data);
          $row++;
          if ($num > 2) {
            echo '<tr>';
            for ($c=0; $c < $num; $c++) {
                if ($c == 0){
                  echo '<th scope="row">'.$data[$c].'</th>';
                }
                elseif ($c == 1) {
                  echo '<td>'.$data[$c].'-img</td>';
                }


                else echo '<td>'.$data[$c].'</td>';
            }
            echo '</tr>';
          }
        }
      }

    echo '</tbody></table>';
    fclose($handle);
      ?>




        <table class="table" id="product-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>img</td>
                    <td>quantity</td>
                    <td>name</td>
                    <td>price</td>
                    <td>description</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>img</td>
                    <td>quantity</td>
                    <td>name</td>
                    <td>price</td>
                    <td>description</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>img</td>
                    <td>quantity</td>
                    <td>name</td>
                    <td>price</td>
                    <td>description</td>
                </tr>
            </tbody>
        </table>
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