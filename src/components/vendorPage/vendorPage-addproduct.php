<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="../../../public/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../src/assets/styles/vendorPage.css?v=<?php echo time(); ?>">
  <style>
    <?php include '../../../src/assets/styles/vendorPage.css'; ?>
  </style>
</head>

<body class="d-flex flex-column">
  <header>
    <?php
    require_once("../../../src/components/header/header.php");
    ?>
  </header>
  <main>
    <div id="register-box" class="d-flex flex-column m-2 p-4 border text-center">
      <div id="page-name" class="text-center">
        <p class="fs-2 fw-bold fst-italic">Add Product</p>
      </div>
      <form name="submit" class="d-flex flex-column" id="" method="post" enctype="multipart/form-data" action="addProduct.php">
        <div class="d-flex flex-row p-2">
          <div class="col-2">
            <label class="form-label me-4" for="prodict-img">Products picture</label>
          </div>
          <div class="col-8">
            <input id="prodict-img" type="file" class="form-control"  onchange="readURL(this);" name="fileToUpload" id="fileToUpload" />
            <img id="blah" src="http://placehold.it/180" alt="your image" />
          </div>
        </div>

        <div id="typical-info">
          <div class="d-flex flex-row p-2">
            <div class="col-2">
              <label class="form-label" for="product-stock">Product stock</label>
            </div>
            <div class="col-8">
              <input id="product-stock" type="text" class="form-control" placeholder="Enter product stock" name="p_stock" ; required />
            </div>
          </div>

          <div class="d-flex flex-row p-2">
            <div class="col-2">
              <label class="form-label" for="product-category">Product category</label>
            </div>
            <div class="col-8">
              <input id="product-category" type="text" class="form-control" placeholder="Enter product category" name="p_category" ; required />
            </div>
          </div>

          <div class="d-flex flex-row p-2">
            <div class="col-2">
              <label class="form-label" for="product-name">Product name</label>
            </div>
            <div class="col-8">
              <input id="product-name" type="text" class="form-control" placeholder="Enter product name" name="p_name" ; required />
            </div>
          </div>

          <div class="d-flex flex-row p-2">
            <div class="col-2">
              <label class="form-label" for="product-price">Product price</label>
            </div>
            <div class="col-8">
              <input id="product-price" type="text" class="form-control" placeholder="Enter product price" name="p_price" ; required />
            </div>
          </div>

          <div id="description-div" class="d-flex flex-row p-2">
            <div class="col-2">
              <label class="form-label me-4" for="description">Description</label>
            </div>
            <div class="col-8">
              <input id="description" type="text" class="form-control" name="p_description" />
            </div>
          </div>
        </div>
        <div class="p-2">

          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary" type="button">
              <input type="submit" value="Add" id="submit-btn" />
            </button>
            <a href="vendorPage.php" class="btn btn-primary text-center" role="button" id="add-product-btn">
              View My Product
            </a>
          </div>
        </div>
        <div id=""></div>
      </form>
    </div>
  </main>
  <footer>
    <?php
    require_once("../../../src/components/footer/footer.html");
    ?>
  </footer>
</body>

<script type="text/javascript">
    <?php include '../../..//src/assets/scripts/vendorPage.js'; ?>
</script>
<link rel="stylesheet" href="/src/assets/scripts/vendorPage.js" />

</html>