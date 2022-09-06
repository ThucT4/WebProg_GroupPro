<?php require_once('../../../server/classes/order.php') ?>
<?php require_once('../../../server/classes/product.php') ?>
<?php require_once('../../../server/writeToFile.php') ?>
<?php require_once('./orderDetails.php') ?>
<?php
// $product1 = new Product("Butterfly Knife", "../../../public/img/product1.png", "Fashion, modern and trending with real iron materials", "Knife", "2500$", "1", "In stock");
// $product2 = new Product("Wireless Headphone", "../../../public/img/product2.webp", "Bluetooth headphone with famous branch - experience music, watch movies all day", "Headphone", "200$", "1", "In stock");
// $product3 = new Product("iPhone 13 256GB", "../../../public/img/iphone.webp", "Iphone 13 max pro with cheapest price", "phone", "1250$", "2", "In stock");
// $productList = array($product1, $product2);
// $obj = new Order("123456789", "Kisari", "../../../public/img/iphone.webp", "SB386", "13/08/2022", "distribution hub address", "Ho Chi Minh city", $productList);
// writeToFile($obj, "order.txt", "a");
// writeToFile($product3, "product.txt");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="shipperPage.css"> -->
    <link rel="stylesheet" href="../../assets/styles/shipperPage.css?v=<?php echo time(); ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>
<!-- || ($cur->status == "Not delivered") -->

<body>
    <header>
        <?php
        require_once('../header/header.php');
        ?>
    </header>
    <?php
    if (isset($_POST['changeOrderId']) && isset($_POST['changeOrderStatus'])) {
        $AllOrders = readFromLocalFile("order.txt");
        foreach ($AllOrders as $order) {
            if (!empty($order)) {
                if ($order->id == $_POST['changeOrderId']) {
                    $order->status = $_POST['changeOrderStatus'];
                }
            }
        }
        changeConfirmStatus($AllOrders);
        Header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

    ?>
    <main class="d-flex flex-lg-row flex-column justify-content-evenly py-md-4">
        <section class="col-lg-3">
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
        <section class="col-lg-8 order-section">
            <div class="p-4 order-details" style="visibility: hidden;">
                <?php showOrderDetails($orderList[0]) ?>
            </div>
        </section>
    </main>
    <footer>
        <?php
        include_once('../footer/footer.html') ?>
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