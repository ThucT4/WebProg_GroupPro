<?php
function filter()
{
    $userList = readFromFile("accounts.txt");
    $hubList = readFromFile('distributionHubs.txt');
    $currentUser = new stdClass();
    foreach ($userList as $user) {
        if ($user->username == $_SESSION['user']) {
            $currentUser = $user;
            break;
        }
    }
    $newList = [];
    $data = readFromFile("order.txt");
    foreach ($data as $object) {
        if (empty($object)) continue;
        if ($object->status == "active") {
            foreach ($hubList as $hub) {
                if ($hub->address == $object->from && $currentUser->hub == $hub->name) {
                    array_push($newList, $object);
                    break;
                }
            }
        }
    }
    return $newList;
}
$orderList = filter();
?>

<?php function showOrderDetails($obj)
{
    $userList = readFromFile("accounts.txt");
    $currentUser = new stdClass();
    foreach ($userList as $user) {
        if ($user->username == $_SESSION['user']) {
            $currentUser = $user;
            break;
        }
    }
    echo $currentUser->address;
    echo
    <<<CODE
        <h2 class="text-center text-bold">#Order$obj->id</h2>
        <div class="progress-track mt-5">
            <ul id="progressbar">
                <li class="active" id="step1">Ordered</li>
                <li class="text-center" id="step2">Shipped</li>
                <li class="text-right" id="step3">On the way</li>
                <li class="text-right" id="step4">Delivered</li>
            </ul>
        </div>
        <div class="customer-info d-flex align-items-center">
            <div class="col-4 col-md-3 avatar d-flex flex-column text-center">
                <img class="img-fluid rounded w-100" src="$currentUser->avt" alt="avatar">
            </div>
            <div class="col-4 col-md-3 ms-4 address d-flex flex-column text-start text-wrap">
                <h3 class="m-0">
                    Delivery address</h3>
                <p class="text-primary">$obj->customerName</p>
                <div class="text-secondary">
                    <span>(+84) 888491388</span>
                    <br>
                    <span>$obj->to</span>
                </div>
            </div>
        </div>
        <div class="product">
            <div class="d-flex align-items-center text-md-center">
                <div class="col-7">Product</div>
                <p class="col-2 p-md-2 text-center">Unit price</p>
                <p class="col-1 p-md-1 text-center">Qty</p>
                <p class="col-2 p-md-1 text-center">Status</p>
            </div>
    CODE;
    $totalPrice = 0;
    foreach ($obj->productList as $cur) {
        $totalPrice += floatval($cur->unitPrice) * floatval($cur->amount);
        echo
        <<<CODE
            <div class="product-list border border-1 py-2">
                <div class="product-list-item d-flex align-items-center">
                    <div class="col-2 col-md-2 d-flex flex-column text-center" style="height: 15vw">
                        <img class="img-fluid rounded w-100 h-100" src="$cur->img" alt="$cur->img">
                    </div>
                    <p class="col-3 p-md-2 text-center text-lg-start">$cur->productDes</p>
                    <div class="catogory col-2 col-md-2 d-flex flex-column p-md-2 text-center">
                        <span>catogory</span>
                        <small>$cur->category </small>
                    </div>
                    <p class="col-2 price p-md-2 text-center">$cur->unitPrice </p>
                    <p class="col-1 amount p-md-2 text-center">$cur->amount </p>
                    <p class="col-2 status p-md-2 text-center">In stock</p>
                </div>
            </div>
        CODE;
    };
    $totalPay = $totalPrice - 20;
    echo
    <<<CODE
        </div>
        <div class="my-md-4">
            <div class="d-flex align-items-center">
                <p class="col-6 col-md-6 p-md-2 text-secondary text-end">
                Total amount</p>
                <p class="col-6 col-md-6 text-end pe-md-3">$totalPrice$</p>
            </div>
            <div class="d-flex align-items-center">
                <p class="col-6 col-md-6 p-md-2 text-secondary text-end">Shipping fee</p>
                <p class="col-6 col-md-6 text-end pe-md-3">20$</p>
            </div>
            <div class="d-flex align-items-center">
                <p class="col-6 col-md-6 p-md-2 text-secondary text-end">Total paymment</p>
                <p class="col-6 col-md-6 text-end pe-md-3 fs-4 text-danger">$totalPay$</p>
            </div>
        </div>
        <div class="w-100 d-flex justify-contents-center align-items-center ps-md-5 border border-warning p-md-3">
            <div style="width: 1.5rem;">
                <img class="img-fluid rounded card-img-top" src="/public/img/notification.png" alt="a bell">
            </div>
            <small class="text-secondary ms-md-2">
            Please pay <strong class="text-warning">$totalPay$</strong> upon receipt</small>
        </div>
        <div class="my-md-4">
            <div class="d-flex align-items-center">
                <p class="col-6 col-md-6 p-md-2 text-secondary text-end">
                Payment method</p>
                <p class="col-6 col-md-6 text-end pe-md-3">
                Payment on delivery</p>
            </div>
        </div>
        <form action="#" method="post">
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
                <button type="submit" class="btn btn-outline-success confirm" onclick="location.reload();">Confirm</button>
            </div>
        </form>
    CODE;
} ?>

