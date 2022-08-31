<?php require_once('../../../server/writeToFile.php') ?>
<?php require_once('../../../server/readFromFile.php') ?>
<?php require_once('../../../server/classes/product.php') ?>
<?php
$productList = readFromFile("../../../server/product.txt");
$id = $_GET['product'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<header>
    <?php
    include_once('../header/header.html');
    ?>
</header>

<body>
    <main>
        <?php foreach ($productList as $product) : ?>
            <?php if (!empty($product)) : ?>
                <?php if ($product->productID == $id) : ?>
                    <section class="d-flex flex-column flex-md-row p-4 justify-content-md-around">
                        <div class="col-md-5 text-center p-2">
                            <img class="img-fluid h-100 w-100 border border-2 rounded" src="../../<?= $product->img ?>" alt="<?= $product->productDes ?>">
                        </div>
                        <div class="col-md-6">
                            <div class="p-2">
                                <h1 class="fs-2">
                                    <?= $product->productName ?>
                                </h1>
                                <h2 class="fs-4 text-primary">
                                    <?= $product->category ?>
                                </h2>
                                <div class="d-flex flex-row flex-wrap fs-5">
                                    <div class="d-flex text-danger border-end border-2 pe-2">
                                        <span class="text-bold">5.0</span>
                                        <span class="text-bold mx-1">&starf;&starf;&starf;&starf;&starf;</span>
                                    </div>
                                    <div class="d-flex border-end border-2 px-2">
                                        <span class="text-bold"><?php echo (rand(100, 1000)) ?></span>
                                        <span class="text-bold text-muted mx-1">reviewers</span>
                                    </div>
                                    <div class="d-flex border-end border-2 px-2">
                                        <span class="text-bold"><?php echo (rand(10, 20)) ?>,<?php echo (rand(1, 9)) ?>k</span>
                                        <span class="text-bold text-muted mx-1">comments</span>
                                    </div>
                                    <div class="d-flex px-2">
                                        <span class="text-bold"><?php echo (rand(1, 9)) ?>,<?php echo (rand(1, 9)) ?></span>
                                        <span class="text-bold text-muted mx-1">sold</span>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <p class="fw-bold fs-3 m-0"><?= $product->unitPrice ?></p>
                                </div>
                                <div>
                                    <p class="m-0 text-muted"><?= $product->productDes ?> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptas dolorum autem ratione obcaecati tenetur, quia delectus esse deleniti minima. Repudiandae perspiciatis velit tempora voluptatum odio ut quibusdam laboriosam, blanditiis consequuntur!</p>
                                </div>
                                <div class="d-flex flex-row align-items-center my-3">
                                    <span class="col-3">Move to</span>
                                    <span>
                                        <img src="../../../public/img/moving-truck.png" alt="moving truck" style="width:30px;height:30px">
                                    </span>
                                    <span class="ms-3">
                                        To : user->to
                                    </span>
                                </div>
                                <div class="d-flex flex-row align-items-center my-3">
                                    <span class="col-3">Quantity</span>
                                    <div class="input-group btn-parent">
                                        <span class="input-group-btn">
                                            <button class="btn btn-minuse border border-3" type="button">-</button>
                                        </span>
                                        <input type="text" class="p-0 text-center border border-3 quantity" maxlength="3" value="1" disable onselectstart="return false;" onmousedown="return false;">
                                        <span class=" input-group-btn">
                                            <button class="btn btn-pluss border border-3" type="button">+</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 d-flex my-5">
                                    <button class="w-50 btn btn-outline-warning rounded-3" onclick="addToCart()">
                                        <img class="me-4" src="../../../public/img/add-to-cart.png" alt="Add-to-cart icon" style="width:30px;height:30px">Add to cart
                                    </button>
                                    <button class="w-25 btn btn-success ms-5 rounded-3">Buy now</button>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif ?>
            <?php endif ?>
        <?php endforeach ?>

    </main>
</body>
<footer><?php include_once('../footer/footer.html'); ?></footer>
<script>
    var minus = document.getElementsByClassName('btn-minuse');
    var plus = document.getElementsByClassName('btn-pluss');
    for (let i = 0; i < minus.length; i++) {
        minus[i].addEventListener('click', function() {
            if (minus[0].closest("span").nextElementSibling.value > 1) {
                minus[0].closest("span").nextElementSibling.value = parseInt(minus[0].closest("span").nextElementSibling.value) - 1
            }
        })
        plus[i].addEventListener('click', function() {
            plus[0].closest("span").previousElementSibling.value = parseInt(plus[0].closest("span").previousElementSibling.value) + 1
        })

    }
</script>
<script>
    function addToCart() {
        var id = <?php echo json_encode($id); ?>;
        var amount = document.getElementsByClassName("quantity")[0].value;
        var isExist = 0;
        <?php foreach ($productList as $product) : ?>
            <?php if (!empty($product)) : ?>
                <?php if ($product->productID == $id) : ?>
                    if (localStorage.getItem("cart") !== null) {
                        var currentStorage = JSON.parse(localStorage.getItem("cart"))
                        currentStorage.forEach(object => {
                            if (object[0].localeCompare(id) == 0) {
                                isExist = 1;
                            };
                        });
                        if (isExist == 0) {
                            currentStorage.push([id, amount])
                            localStorage.setItem("cart", JSON.stringify(currentStorage));
                        }
                    } else {
                        var listOfProduct = [];
                        listOfProduct.push([id, amount])
                        localStorage.setItem("cart", JSON.stringify(listOfProduct))
                    }
                <?php endif ?>
            <?php endif ?>

        <?php endforeach; ?>
    }
</script>

</html>