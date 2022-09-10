<?php session_start(); ?>
<?php require_once('../../../server/writeToFile.php') ?>
<?php require_once('../../../server/readFromFile.php') ?>
<?php require_once('../../../server/classes/product.php') ?>
<?php $productList = readFromFile("product.txt") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../src/assets/styles/mainPage.css">
    <link rel="stylesheet" href="../../assets/styles/mainPage.css?v=<?php echo time(); ?>">
</head>


<body>
    <header>
        <?php include_once('../header/header.php'); ?>
    </header>
    <?php
    if (isset($_SESSION['user'])) {
        if ($_SESSION['accounttype'] != 'customer') {
            echo <<<CODE
                <script type="text/javascript">  
                window.location.href="../noPermission/noPermission.html";
            </script>
            CODE;
        }
    }
    ?>
    <main class="py-lg-3 px-lg-5">
        <section class="p-4 banner">
            <div class="d-flex flex-column flex-md-row justify-content-evenly h-100">
                <div class="col-12 col-md-8 main-banner">
                    <div id="carouselExampleCaptions" class="carousel slide carousel-fade h-100" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner h-100 ">
                            <div class="carousel-item active h-100">
                                <img src="../../../public/img/banner1.webp" class="d-block w-100 img-fluid h-100" alt="banner1">
                            </div>
                            <div class="carousel-item h-100">
                                <img src="../../../public/img/banner2.jpg" class="d-block w-100 img-fluid h-100" alt="banner2">
                            </div>
                            <div class="carousel-item h-100">
                                <img src="../../../public/img/banner3.webp" class="d-block w-100 img-fluid h-100" alt="banner3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-3 d-flex flex-md-column justify-content-between sub-banner">
                    <div class="col-6 col-md-12">
                        <img src="../../../public/img/banner4.webp" class="img-fluid w-100 h-100" alt="banner4">
                    </div>
                    <div class="col-6 col-md-12">
                        <img src="../../../public/img/banner5.webp" class="img-fluid w-100 h-100" alt="banner4">
                    </div>
                </div>
            </div>
        </section>
        <div class="px-4">
            <div class="d-flex flex-wrap justify-contents-center">
                <div class="col-4 col-lg-2 d-flex flex-column align-items-center justify-content-center text-center h-100 py-2">
                    <div class="border border-1 rounded-circle p-2" style="width: 50px; height: 50px;">
                        <img src="../../../public/img/banner-icon1.png" class="icon-40 img-fluid" alt="Sale">
                    </div>
                    <p class="mt-2 w-100">Hot Time for sale</p>
                </div>
                <div class="col-4 col-lg-2 d-flex flex-column align-items-center justify-content-center text-center h-100 py-2">
                    <div class="border border-1 rounded-circle p-2" style="width: 50px; height: 50px;">
                        <img src="../../../public/img/banner-icon2.png" class="icon-40 img-fluid" alt="Cheap">
                    </div>
                    <p class="mt-2 w-100">Cheapest price</p>
                </div>
                <div class="col-4 col-lg-2 d-flex flex-column align-items-center justify-content-center text-center h-100 py-2">
                    <div class="border border-1 rounded-circle p-2" style="width: 50px; height: 50px;">
                        <img src="../../../public/img/banner-icon3.png" class="icon-40 img-fluid" alt="Sale">
                    </div>
                    <p class="mt-2 w-100">Free ship</p>
                </div>
                <div class="col-4 col-lg-2 d-flex flex-column align-items-center justify-content-center text-center h-100 py-2">
                    <div class="border border-1 rounded-circle p-2" style="width: 50px; height: 50px;">
                        <img src="../../../public/img/banner-icon4.png" class="icon-40 img-fluid" alt="Sale">
                    </div>
                    <p class="mt-2 w-100">Best quality goods</p>
                </div>
                <div class="col-4 col-lg-2 d-flex flex-column align-items-center justify-content-center text-center h-100 py-2">
                    <div class="border border-1 rounded-circle p-2" style="width: 50px; height: 50px;">
                        <img src="../../../public/img/banner-icon5.png" class="icon-40 img-fluid" alt="Sale">
                    </div>
                    <p class="mt-2 w-100">Reasonable price- Hot deal</p>
                </div>
                <div class="col-4 col-lg-2 d-flex flex-column align-items-center justify-content-center text-center h-100 py-2">
                    <div class="border border-1 rounded-circle p-2" style="width: 50px; height: 50px;">
                        <img src="../../../public/img/banner-icon6.png" class="icon-40 img-fluid" alt="Sale">
                    </div>
                    <p class="mt-2 w-100">International supplier</p>
                </div>
            </div>
        </div>
        <section class="p-4">
            <div class="d-flex flex-wrap justify-content-around px-2 py-4">
                <?php foreach ($productList as $cur) : ?>
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
            </div>
        </section>
    </main>
    <footer><?php include_once('../footer/footer.html') ?></footer>
</body>
<link rel="stylesheet" href="/src/assets/scripts/mainPage.js">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</html>