<?php session_start(); ?>
<?php require_once('../../../server/writeToFile.php') ?>
<?php require_once('../../../server/readFromFile.php') ?>
<?php require_once('../../../server/classes/product.php') ?>
<?php
$productList = readFromFile("product.txt");
$input = $_GET['name'];
$productFilterList = [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../src/assets/styles/customerPage.css?v=<?php echo time(); ?>">
</head>
<header>
    <?php
    include_once('../header/header.php');
    ?>
</header>
<?php
if (isset($_SESSION['user'])) {
    if ($_SESSION['accounttype'] != 'customer') {
        header("Refresh:0; url=../noPermission/noPermission.html");
    }
} else {
    header("url=../loginPage/login.php");
}
?>
<?php
$query = explode(',', $input);
if (sizeof($query) == 2 && is_numeric($query[0]) && is_numeric($query[1])) {
    foreach ($productList as $item) {
        $itemPrice = floatval($item->unitPrice);
        if ((floatval($query[0]) <= $itemPrice) && ($itemPrice <= floatval($query[1]))) {
            array_push($productFilterList, $item);
        }
    }
} elseif (sizeof($query) == 1) {
    $filter = trim($query[0]);
    $regex = "/{$filter}/i";
    foreach ($productList as $item) {
        if (preg_match($regex, $item->productName) == 1) {
            array_push($productFilterList, $item);
        }
    }
}
// if (is_numeric($input)) {
//     echo "this is a num";
// } else {
//     echo "this is not a num";
// }
// foreach ($productList as $item) {
// }
?>

<body>
    <main class="py-3 px-5">
        <div class="d-flex flex-wrap justify-content-around px-2 py-4">
            <?php if (sizeof($productFilterList) == 0) : ?>
                <div class="col-12 text-center fs-2" style="min-height: 100vh;">Nothing found</div>
            <?php else : ?>
                <div class="col-12 text-center fs-2 mb-4"><?= sizeof($productFilterList) ?> products was found</div>
                <?php foreach ($productFilterList as $cur) : ?>
                    <?php if (!empty($cur)) : ?>
                        <div class="card mx-2 my-4 col-10 col-sm-8 col-md-5 col-lg-3">
                            <img src="../../<?= $cur->img ?>" class="card-img-top" alt="<?= $cur->productDes ?>">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?= $cur->productName ?></h5>
                                <div class="card-subtitle my-2 text-muted w-100 d-flex justify-content-between ">
                                    <!-- <span class="text-decoration-line-through d-flex align-items-center"><?= $cur->unitPrice ?></span> -->
                                    <span class="fs-3"><strong><?= $cur->unitPrice ?></strong></span>
                                </div>
                                <p class="card-text text-start"><?= $cur->productDes ?></p>
                            </div>
                            <div class="card-body d-flex align-items-end">
                                <a href="../productPage/productDetails.php?product=<?php echo $cur->productID ?>" class="stretched-link btn btn-primary w-100">View the product</a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
    <footer><?php include_once('../footer/footer.html'); ?></footer>
</body>
<link rel="stylesheet" href="/src/assets/scripts/mainPage.js">

</html>

<script>
</script>