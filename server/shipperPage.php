<?php
// $obj = new stdClass();
// $obj->id = "35981";
// $obj->customerName = "Kisari";
// $obj->productName = "Iphone 13 max pro";
// $obj->img = "../public/img/iphone.webp";
// $obj->productID = "SB386";
// $obj->date = "13/08/2022";
// $obj->from = "Tien Giang";
// $obj->to = "Ho Chi Minh city";


// $objData = serialize( $obj);
$filePath = getcwd() . DIRECTORY_SEPARATOR . "test.db";
// if (is_writable($filePath)) {
//     $file = fopen($filePath, "a"); 
//     fwrite($file, $objData);
//     fwrite($file, "\n");
//     fclose($file);
// }

//             if (file_exists($filePath)){
//                 $objData = file_get_contents($filePath);
//                 $obj = unserialize($objData);
//                 if (!empty($obj)){
//                     $name = $obj->name;
//                     $birthdate = $obj->birthdate;
//                     $position = $obj->position;
//                     echo $name, $birthdate, $position;
//                 }
// }
$orderList = [];
$currentOrder = new stdClass();
if (file_exists($filePath)) {
    $file = fopen($filePath, "r");
    while (!feof($file)) {
        $line = fgets($file);
        $obj = unserialize($line);
        // echo print_r($obj);
        // if (!empty($obj)){
        // $name = $obj->name;
        // $birthdate = $obj->birthdate;
        // $position = $obj->position;
        // echo '<div class="my_class">';
        // echo ($cart->count_product > 0) ? $cart->count_product : '';
        // echo '</div>';
        array_push($orderList, $obj);
    }
}
fclose($file);
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
                <a href="#" class="list-group-item list-group-item-action" aria-current="true"
                    onclick="showDetails(' <?= $cur->id; ?>');">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?= $cur->customerName ?></h5>
                        <small><?= $cur->date ?></small>
                    </div>
                    <p class="mb-1"><?= $cur->productName ?></p>
                    <small>From: <?= $cur->from ?> To: <?= $cur->to ?></small>
                    <img class="img-fluid rounded mx-auto d-block" src="<?= $cur->img ?>"
                        alt="<?= $cur->productName ?>">
                </a>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="col-8">
            <div class="p-4">
                <h2 class="text-center text-bold">#Order35695</h2>
                <div class="progress-track mt-5">
                    <ul id="progressbar">
                        <li class="active" id="step1">Ordered</li>
                        <li class="active text-center" id="step2">Shipped</li>
                        <li class="active text-right" id="step3">On the way</li>
                        <li class="text-right" id="step4">Delivered</li>
                    </ul>
                </div>
                <div class="customer-info d-flex align-items-center h-100">
                    <div class="col-4 col-md-3 avatar d-flex flex-column text-center">
                        <img class="img-fluid rounded" src="/public/img/avatar.jpg" alt="avatar">
                    </div>
                    <div class="col-4 col-md-3 address d-flex flex-column text-start text-wrap">
                        <h3 class="m-0">
                            Delivery address</h3>
                        <p class="text-primary">Kisari</p>
                        <div class="text-secondary">
                            <span>(+84) 888491388</span>
                            <br>
                            <span>702 Nguyễn Văn Linh, Tân Hưng, Quận 7, Thành phố Hồ Chí Minh</span>
                        </div>
                    </div>

                </div>
                <!-- <div class="address d-flex justify-content-between p-4">
                    <div class="card" style="width: 12rem;">
                        <img class="img-fluid rounded card-img-top" src="/public/img/from.png" alt="iphone">
                        <div class="card-body">
                            <p class="card-text">Phường Phú Hữu, Quận 9, Thành phố Hồ Chí Minh</p>
                        </div>
                    </div>
                    <div>

                    </div>
                    <div class="card" style="width: 12rem;">
                        <img class="img-fluid rounded card-img-top" src="/public/img/to.png" alt="iphone">
                        <div class="card-body">
                            <p class="card-text">702 Nguyễn Văn Linh, Tân Hưng, Quận 7, Thành phố Hồ Chí Minh</p>
                        </div>
                    </div>
                </div> -->
                <div class="product-list">
                    <div class="product-list-item d-flex align-items-center h-100 text-md-center">
                        <div class="col-8 col-md-9">Product</div>
                        <p class="col-2 col-md-1 p-md-2">Unit price</p>
                        <p class="col-1 p-md-2">Amount</p>
                        <p class="col-1 p-md-2">Status</p>
                    </div>
                    <?php
                    foreach ($orderList as $cur) :
                    ?>
                    <div class="product-list-item d-flex align-items-center h-100">
                        <img class="col-3 col-md-2 img-fluid rounded" src="/public/img/iphone.webp" alt="iphone">
                        <p class="col-3 col-md-4 p-md-2">Iphone with the cheapest
                            price,
                            modern
                            design, 13
                            new
                            inovations and
                            associated
                            functions</p>
                        <div class="catogory col-2 col-md-3 d-flex flex-column p-md-2 text-md-center">
                            <span>catogory</span>
                            <small>iphone</small>
                        </div>
                        <p class="col-2 col-md-1 price p-md-2 text-md-center">1500$</p>
                        <p class="col-1 amount p-md-2 text-md-center">1</p>
                        <p class="col-1 status p-md-2">In stock</p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="my-md-4">
                    <div class="product-list-item d-flex align-items-center h-100">
                        <p class="col-6 col-md-6 p-md-2 text-secondary text-end">
                            Total amount</p>
                        <p class="col-6 col-md-6 text-md-end pe-md-3">45212$</p>
                    </div>
                    <div class="product-list-item d-flex align-items-center h-100">
                        <p class="col-6 col-md-6 p-md-2 text-secondary text-end">Shipping fee</p>
                        <p class="col-6 col-md-6 text-md-end pe-md-3">20$</p>
                    </div>
                    <div class="product-list-item d-flex align-items-center h-100">
                        <p class="col-6 col-md-6 p-md-2 text-secondary text-end">Total paymment</p>
                        <p class="col-6 col-md-6 text-md-end pe-md-3 fs-4 text-danger">45232$</p>
                    </div>
                </div>
                <div
                    class="w-100 d-flex justify-contents-center align-items-center ps-md-5 border border-warning p-md-3">
                    <div style="width: 1.5rem;">
                        <img class="img-fluid rounded card-img-top" src="/public/img/notification.png" alt="a bell">
                    </div>
                    <small class="text-secondary ms-md-2">
                        Please pay <strong class="text-warning">45232$</strong> upon receipt</small>
                </div>
                <div class="my-md-4">
                    <div class="product-list-item d-flex align-items-center h-100">
                        <p class="col-6 col-md-6 p-md-2 text-secondary text-end">
                            Payment method</p>
                        <p class="col-6 col-md-6 text-md-end pe-md-3">
                            Payment on delivery</p>
                    </div>
                </div>
                <div class="d-flex justify-content-end my-md-4 pe-md-3">
                    <button type="button" class="btn btn-outline-success">Confirm</button>
                </div>
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
    <?php foreach ($orderList as $orderItem) : ?>
    var orderObjectData = '<?php echo json_encode($orderItem); ?>';
    var orderObject = JSON.parse(orderObjectData);
    if (orderObject.id == $cur.trim()) {
        console.log(orderObject);
    }
    <?php endforeach; ?>
}
</script>

</html>