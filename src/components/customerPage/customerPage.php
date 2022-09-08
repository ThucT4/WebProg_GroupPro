<?php require_once('../../../server/writeToFile.php') ?>
<?php require_once('../../../server/readFromFile.php') ?>
<?php require_once('../../../server/classes/product.php') ?>
<?php
$productList = readFromFile("product.txt");
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
<?php
if (isset($_SESSION['user'])) {
    if ($_SESSION['accounttype'] != 'customer') {
        header("Refresh:0; url=../noPermission/noPermission.html");
    }
} else {
    header("url=../loginPage/login.php");
}
?>

<body>
    <main class="py-3 px-5">
        <div class="d-flex flex-wrap justify-content-around px-2 py-4">
            <?php foreach ($productList as $cur) : ?>
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
                            <a href="../productPage/productDetails.php?product=<?php echo $cur->productID ?>" class="stretched-link btn btn-primary w-100">View the product</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </main>
    <footer><?php include_once('../footer/footer.html'); ?></footer>
</body>
<link rel="stylesheet" href="/src/assets/scripts/mainPage.js">

</html>

<script>
</script>