<?php function filter()
{
    $newList = [];
    $data = readFromLocalFile("order.txt");
    foreach ($data as $object) {
        if (empty($object)) continue;
        if ($object->status == "active") {
            array_push($newList, $object);
        }
    }
    return $newList;
}
$orderList = filter();
$totalPrice = 0;
?>

<?php function showOrderDetails($obj)
{
    echo
    <<<CODE
        <h2 class="text-center text-bold">#Order35695</h2>
        <div class="progress-track mt-5">
            <ul id="progressbar">
                <li class="active" id="step1">Ordered</li>
                <li class="text-center" id="step2">Shipped</li>
                <li class="text-right" id="step3">On the way</li>
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
                <p class="text-primary">$obj->customerName</p>
                <div class="text-secondary">
                    <span>(+84) 888491388</span>
                    <br>
                    <span>702 Nguyễn Văn Linh, Tân Hưng, Quận 7, Thành phố Hồ Chí Minh</span>
                </div>
            </div>
        </div>
        <div class="product">
            <div class="d-flex align-items-center h-100 text-md-center">
                <div class="col-8 col-md-9">Product</div>
                <p class="col-2 col-md-1 p-md-2">Unit price</p>
                <p class="col-1 p-md-2">Amount</p>
                <p class="col-1 p-md-2">Status</p>
            </div>
    CODE;

    foreach ($obj->productList as $cur) {
        echo
        <<<CODE
            <div class="product-list">
                <div class="product-list-item d-flex align-items-center h-100">
                    <img class="col-3 col-md-2 img-fluid rounded" src="$cur->img" alt="$cur->img">
                    <p class="col-3 col-md-4 p-md-2">$cur->productDes</p>
                    <div class="catogory col-2 col-md-3 d-flex flex-column p-md-2 text-md-center">
                        <span>catogory</span>
                        <small>$cur->category </small>
                    </div>
                    <p class="col-2 col-md-1 price p-md-2 text-md-center">$cur->unitPrice </p>
                    <p class="col-1 amount p-md-2 text-md-center">$cur->amount </p>
                    <p class="col-1 status p-md-2">In stock</p>
                </div>
            </div>
        CODE;
    };

    echo
    <<<CODE
        </div>
        <div class="my-md-4">
            <div class="d-flex align-items-center h-100">
                <p class="col-6 col-md-6 p-md-2 text-secondary text-end">
                Total amount</p>
                <p class="col-6 col-md-6 text-md-end pe-md-3">45212$</p>
            </div>
            <div class="d-flex align-items-center h-100">
                <p class="col-6 col-md-6 p-md-2 text-secondary text-end">Shipping fee</p>
                <p class="col-6 col-md-6 text-md-end pe-md-3">20$</p>
            </div>
            <div class="d-flex align-items-center h-100">
                <p class="col-6 col-md-6 p-md-2 text-secondary text-end">Total paymment</p>
                <p class="col-6 col-md-6 text-md-end pe-md-3 fs-4 text-danger">45232$</p>
            </div>
        </div>
        <div class="w-100 d-flex justify-contents-center align-items-center ps-md-5 border border-warning p-md-3">
            <div style="width: 1.5rem;">
                <img class="img-fluid rounded card-img-top" src="/public/img/notification.png" alt="a bell">
            </div>
            <small class="text-secondary ms-md-2">
            Please pay <strong class="text-warning">45232$</strong> upon receipt</small>
        </div>
        <div class="my-md-4">
            <div class="d-flex align-items-center h-100">
                <p class="col-6 col-md-6 p-md-2 text-secondary text-end">
                Payment method</p>
                <p class="col-6 col-md-6 text-md-end pe-md-3">
                Payment on delivery</p>
            </div>
        </div>
        <form action="" method="post">
            <div class="d-flex justify-content-end align-items-center my-md-4 pe-md-3">
                <input class="d-none" type="text" name="changeOrderId" value="$obj->id">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="changeOrderStatus" id="changeORderStatus1" value="active" checked>
                    <label class="form-check-label" for="changeORderStatus1">active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="changeOrderStatus" id="changeORderStatus2" value="delivered">
                    <label class="form-check-label" for="changeORderStatus2">delivered</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="changeOrderStatus" id="changeORderStatus3" value="canceled">
                    <label class="form-check-label" for="changeORderStatus3">canceled</label>
                </div>
                <button type="submit" class="btn btn-outline-success confirm">Confirm</button>
            </div>
        </form>
    CODE;
} ?>

