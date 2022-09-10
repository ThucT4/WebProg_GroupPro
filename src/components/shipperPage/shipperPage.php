<?php session_start(); ?>
<?php require_once('../../../server/classes/order.php') ?>
<?php require_once('../../../server/classes/product.php') ?>
<?php require_once('../../../server/classes/account.php') ?>
<?php require_once('../../../server/classes/distributionHub.php') ?>
<?php require_once('../../../server/writeToFile.php') ?>
<?php require_once('./orderDetails.php') ?>
<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/styles/shipperPage.css?v=<?php echo time(); ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>

<body>
    <header>
        <?php
        require_once('../header/header.php');
        ?>
    </header>
    <?php
    if (isset($_SESSION['user'])) {
        if ($_SESSION['accounttype'] != 'shipper') {
            echo <<<CODE
                <script type="text/javascript">
                window.location.href="../noPermission/noPermission.html";
            </script>
            CODE;
        }
    }
    ?>
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
        echo ("<script>location.href = '../shipperPage/shipperPage.php';</script>");
    }
    ?>
    <main class="d-flex flex-lg-row flex-column justify-content-evenly py-md-4">
        <section class="col-lg-3">
            <div class="list-group">
                <?php if (sizeof($orderList) == 0) : ?>
                    <div class="text-center my-4">
                        There are no orders in your hub distribution
                    </div>
                <?php endif; ?>
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