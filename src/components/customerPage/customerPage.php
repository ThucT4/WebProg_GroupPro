<?php require_once('../../../server/writeToFile.php') ?>
<?php require_once('../../../server/readFromFile.php') ?>
<?php require_once('../../../server/classes/product.php') ?>
<?php
$productList = readFromFile("../../../server/product.txt");
$productListFilter = array();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../src/assets/styles/mainPage.css">
</head>
<header>
    <?php
    include_once('../header/header.php');
    ?>
</header>

<body>
    <main class="py-3 px-5">
        <div class="d-flex flex-wrap justify-content-around px-2 py-4">
            <?php foreach ($productListFilter as $cur) : ?>
                <?php if (!empty($cur)) : ?>
                    <div class="card mx-2 my-4" style="width: 25%;">
                        <img src="../../<?= $cur->img ?>" class="card-img-top" alt="<?= $cur->productDes ?>">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?= $cur->productName ?></h5>
                            <div class="card-subtitle my-2 text-muted w-100 d-flex justify-content-between ">
                                <span class="text-decoration-line-through d-flex align-items-center"><?= $cur->unitPrice ?></span>
                                <span class="fs-3"><strong><?= $cur->unitPrice ?></strong></span>
                            </div>
                            <p class="card-text text-start" style="min-height: 50px;"><?= $cur->productDes ?></p>
                        </div>
                        <div class="card-body">
                            <a href="#" class="stretched-link btn btn-primary w-100">View the product</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </main>
    <footer><?php include_once('../footer/footer.html'); ?></footer>
</body>
<link rel="stylesheet" href="/src/assets/scripts/mainPage.js">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</html>

<script>
    //     function filter_price($max, $min) { //fucntion to filter by max/min price        
    //         foreach($productList as $prod) {
    //             if ($min <= $prod - > price && $prod - > price >= $max) {
    //                 array_push($productListFilter, $prod);
    //             }
    //         }
    //     }

    //     function filter_name($search_name) { //fucntion to filter by name
    //         foreach($productList as $prod) {
    //             if (strcmp($prod - > productName, $search_name)) {
    //                 array_push($productListFilter, $prod);
    //             }
    //         }
    //     }

    //     //filter
    //     filter_name($_SESSION['search_name']);
    //     filter_price($_SESSION['max_price'], $_SESSION['min_price']);
    // 
</script>