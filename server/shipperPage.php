<?php require_once('./classes/order.php') ?>
<?php require_once('./classes/product.php') ?>
<?php require_once('./writeToFile.php') ?>
<?php require_once('./readFromFile.php') ?>
<?php require_once('./orderDetails.php') ?>
<?php
$product1 = new Product("SB3589", "Butterfly Knife", "../public/img/product1.png", "Fashion, modern and trending with real iron materials", "Knife", "2500$", "1", "In stock");
$product2 = new Product("UI359", "Wireless Headphone", "../public/img/product2.webp", "Bluetooth headphone with famous branch - experience music, watch movies all day", "Headphone", "200$", "1", "In stock");
$product3 = new Product("BF384", "iPhone 13 256GB", "../public/img/iphone.webp", "Iphone 13 max pro with cheapest price", "phone", "1250$", "2", "In stock");
$productList = array($product1);
$obj = new Order("123456789", "Kisari", "../public/img/iphone.webp", "SB386", "13/08/2022", "Tien Giang", "Ho Chi Minh city", $productList, "Not delivered");
// $orderList = readFromFile("order.txt");
// writeToFile($obj, "order.txt", "a");
// writeToFile($product3, "product.txt", "a");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="shipperPage.css"> -->
    <link rel="stylesheet" href="../src/assets/styles/shipperPage.css?v=<?php echo time(); ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>
<!-- || ($cur->status == "Not delivered") -->

<body>
    <header>
        <?php
        include_once('../src/components/header/header.html');
        ?>
    </header>
    <main class="d-flex justify-content-evenly py-md-4">
        <section class="col-3">
            <div class="list-group">
                <?php
                foreach ($orderList as $cur) :
                ?>
                    <?php if (!empty($cur)) : ?>
                        <a href="#" class="list-group-item list-group-item-action mb-2" aria-current="true" onclick="showDetails(' <?= $cur->id; ?>');">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?= $cur->customerName ?></h5>
                                <small><?= $cur->date ?></small>
                            </div>
                            <p class="mb-1">Total <?= sizeof($cur->productList) ?> products need to be delivered</p>
                            <small>From: <?= $cur->from ?> To: <?= $cur->to ?></small>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="col-8 order-section">
            <div class="p-4 order-details" style="visibility: hidden;">
                <?php showOrderDetails($orderList[0]) ?>
            </div>
        </section>
    </main>
    <footer>
        <?php
        include_once('../src/components/footer/footer.html') ?>
    </footer>
</body>
<script>
    function showDetails($cur) {
        event.preventDefault();
        <?php foreach ($orderList as $orderItem) : ?>
            var orderObjectData = '<?php echo json_encode($orderItem); ?>';
            var orderObject = JSON.parse(orderObjectData);
            if (orderObject.id == $cur.trim()) {
                var orderSection = document.getElementsByClassName("order-section")
                var orderDetails = document.getElementsByClassName("order-details");
                for (var i = orderDetails.length - 1; i >= 0; i--) {
                    orderDetails[i].parentNode.removeChild(orderDetails[i]);
                }
                var div = document.createElement('div');
                div.classList.add('p-4');
                div.classList.add('order-details');
                div.innerHTML = `
                    <?php
                    showOrderDetails($orderItem)
                    ?>
                `
                orderSection[0].appendChild(div);
            }
        <?php endforeach; ?>
    };
</script>

</html>