<?php session_start(); ?>
<?php require_once('../../../server/classes/order.php') ?>
<?php require_once('../../../server/classes/product.php') ?>
<?php require_once('../../../server/readFromFile.php') ?>
<?php require_once('../../../server/writeToFile.php') ?>
<?php require_once('../../../server/classes/distributionHub.php') ?>
<?php require_once('../../../server/classes/account.php') ?>
<?php
$productList = readFromFile("product.txt");
$hub = readFromFile('distributionHubs.txt');
$userList = readFromFile("accounts.txt");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart Page</title>
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../assets/styles/cartPage.css?v=<?php echo time(); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>


<body>
    <header>
        <?php
        require_once('../header/header.php')
        ?>
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
    } else {
        header("url=../loginPage/login.php");
    }
    ?>

    <?php
    if (isset($_POST['productList'])) {
        if (json_decode($_POST['productList'][0]) != null) {
            $productData = [];
            $address = "";
            $start;
            $obj = json_decode($_POST['productList'][0]);
            foreach ($obj as $product) {
                for ($i = 0; $i < sizeof($productList); $i++) {
                    if ($product[0] == $productList[$i]->productID) {
                        $productList[$i]->amount = $product[1];
                        array_push($productData, $productList[$i]);
                        break;
                    }
                }
            }
            foreach ($userList as $user) {
                if ($user->username == $_SESSION['user']) {
                    $address = $user->address;
                    break;
                }
            }
            foreach ($hub as $item) {
                if ($item->name == $_POST['distribution-hub']) {
                    $start = $item->address;
                }
            }
            $newOrder = new Order($_SESSION['user'], $productData[0]->img, date("Y/m/d"), $start, $address, $productData, $_POST['distribution-hub']);
            writeToFile($newOrder, "order.txt", "a");
            echo <<<CODE
            <script type="text/javascript">
                localStorage.clear();
                window.location.href="../mainPage/mainPage.php";
                alert('Your order has been updated! Wait for delivering');
            </script>
            CODE;
        }
    }
    ?>
    <main class="p-3 d-flex flex-wrap flex-column flex-md-row justify-content-between">
        <section class="col-12 col-md-3 d-flex flex-column">
            <div class="p-4 border border-2">
                <h2 class="m-0">Price Details</h2>
                <div class="py-4 my-3 border-bottom border-top border-1 d-flex flex-column fw-bold">
                    <div class="d-flex flex-row flex-wrap justify-content-between align-items-center">
                        <p class="m-0">Price</p>
                        <span class="price-value">None</span>
                    </div>
                    <div class="d-flex flex-row flex-wrap justify-content-between align-items-center mt-3">
                        <p class="m-0">Delivery Charges</p>
                        <span>20$</span>
                    </div>
                </div>
                <div class="d-flex flex-row flex-wrap justify-content-between align-items-center fw-bold">
                    <p class="m-0">Total payment</p>
                    <span class="total-payment">None</span>
                </div>
            </div>
            <form action="" method="post" class="data-form p-4 border border-2 border-top-0 d-flex flex-wrap justify-content-center justify-content-md-between align-items-center">
                <div>
                    <select class="form-select text-truncate" name="distribution-hub" id="distribution-hub" style="max-width: 200px">
                        <?php foreach ($hub as $item) : ?>
                            <optgroup label="<?= $item->name ?>">
                                <option value="<?= $item->name ?>"><?= $item->address ?></option>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <input class="d-none hidden-data" type="text" name="productList[]">
                    <button class="btn btn-success">Confirm</button>
                </div>
            </form>
        </section>
        <section class="col-12 col-md-8 p-4">
            <div>
                <h2 class="w-100 border-1 border-bottom pb-4 fs-5">My Cart</h2>
                <div class="cart-list">
                    <div class="cart d-flex flex-row flex-wrap mt-3 mb-4 justify-content-center">
                        <div class="col-8 col-md-2 border border-secondary">
                            <img class="img-fluid" src="../../../public/img/iphone.webp" alt="">
                        </div>
                        <div class="col-12 col-md-10 d-flex flex-row flex-wrap px-3 py-1 my-4 my-md-0">
                            <div class="col-12 col-md-8 d-flex flex-column">
                                <h3 class="m-0 fs-5 fw-bolder">Iphone 256GB pro max</h3>
                                <small class="p-0"> Sell by Minh</small>
                                <p class="fw-bold fs-4 my-2">$1377</p>
                                <div class="d-flex flex-row">
                                    <button class="btn btn-warning p-2">Save for later</button>
                                    <button class="btn btn-danger p-2 ms-4">Remove</button>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 d-flex align-items-center my-3 my-md-0">
                                <div class="input-group btn-parent d-flex flex-row justify-content-center justify-content-sm-start w-100">
                                    <span class="input-group-btn">
                                        <button class="btn btn-minuse border border-3" type="button">-</button>
                                    </span>
                                    <input type="text" class="p-0 text-center border border-3 quantity form-control" maxlength="3" value="1" disable onselectstart="return false;" onmousedown="return false;">
                                    <span class="input-group-btn">
                                        <button class="btn btn-pluss border border-3" type="button">+</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <?php
        require_once('../footer/footer.html')
        ?>
    </footer>
</body>
<script src="/src/assets/scripts/cartPage.js"></script>
<script>
    function removeProduct(id) {
        console.log(id);
        var currentStorage = JSON.parse(localStorage.getItem("cart"));
        if (currentStorage.length == 1) {
            localStorage.removeItem("cart");
            location.reload();
            return;
        }
        for (let i = 0; i < currentStorage.length; i++) {
            if (currentStorage[i][0].localeCompare(id)) {
                currentStorage = currentStorage.splice(i, i + 1);
                console.log(currentStorage);
                localStorage.setItem("cart", JSON.stringify(currentStorage));
                location.reload();
                break;
            }
        }
    }

    function addAndremoveQty() {
        var minus = document.getElementsByClassName('btn-minuse');
        var plus = document.getElementsByClassName('btn-pluss');
        var currentStorage = JSON.parse(localStorage.getItem("cart"));
        var listOfProduct = [];
        for (let i = 0; i < minus.length; i++) {
            minus[i].addEventListener('click', function() {
                if (minus[i].closest("span").nextElementSibling.value > 1) {
                    minus[i].closest("span").nextElementSibling.value = parseInt(minus[i].closest("span").nextElementSibling.value) - 1
                    currentStorage.forEach(object => {
                        if (object[0].localeCompare(minus[i].closest("div").previousElementSibling.textContent) == 0) {
                            object[1] = minus[i].closest("span").nextElementSibling.value;
                        }
                    });
                    localStorage.setItem("cart", JSON.stringify(currentStorage));
                    location.reload();
                }
            })
            plus[i].addEventListener('click', function() {
                plus[i].closest("span").previousElementSibling.value = parseInt(plus[i].closest("span").previousElementSibling.value) + 1
                currentStorage.forEach(object => {
                    if (object[0].localeCompare(plus[i].closest("div").previousElementSibling.textContent) == 0) {
                        object[1] = plus[i].closest("span").previousElementSibling.value;
                    }
                });
                localStorage.setItem("cart", JSON.stringify(currentStorage));
                location.reload();
            })

        }
    }
</script>

<script>
    function getProductFromCart() {
        var cartSection = document.getElementsByClassName("cart-list")
        var cartDetails = document.getElementsByClassName("cart");
        var totalPayment = 0;
        var currentStorage = JSON.parse(localStorage.getItem("cart"));
        for (var j = cartDetails.length - 1; j >= 0; j--) {
            cartDetails[j].parentNode.removeChild(cartDetails[j]);
        }
        <?php foreach ($productList as $product) : ?>
            <?php if (!empty($product)) : ?>
                if (currentStorage == null) {
                    return;
                } else {
                    for (let i = 0; i < currentStorage.length; i++) {
                        if (currentStorage[i][0] == "<?php echo $product->productID; ?>") {
                            var productObject = '<?php echo json_encode($product); ?>';
                            var product = JSON.parse(productObject);
                            totalPayment += parseFloat(product.unitPrice) * parseInt(currentStorage[i][1]);
                            var div = document.createElement('div');
                            div.classList.add('cart');
                            div.classList.add('d-flex');
                            div.classList.add('flex-row');
                            div.classList.add('flex-wrap');
                            div.classList.add('mt-3');
                            div.classList.add('mb-4');
                            div.classList.add('justify-content-center"');
                            div.classList.add('align-items-center');

                            div.innerHTML = `
                                <div class="cart-img col-12 col-md-2 border border-secondary">
                                    <img class="img-fluid w-100 h-100" src="${product.img}" alt="">
                                </div>
                                <div class="col-12 col-md-10 d-flex flex-row flex-wrap px-3 py-1 my-4 my-md-0">
                                    <div class="col-12 col-md-8 d-flex flex-column">
                                        <h3 class="m-0 fs-5 fw-bolder">${product.productName}</h3>
                                        <small class="p-0"> Sell by ${product.vendorName}</small>
                                        <p class="fw-bold fs-4 my-2">${product.unitPrice}</p>
                                        <div class="d-flex flex-column flex-sm-row">
                                            <button class="btn btn-warning p-2">Save for later</button>
                                            <button class="btn btn-danger p-2 ms-sm-4 my-sm-0 my-3" onclick="removeProduct(${product.productID});">Remove</button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex align-items-center my-3 my-md-0">
                                        <small class="d-none">${product.productID}</small>
                                        <div class="input-group btn-parent d-flex flex-row justify-content-center justify-content-sm-start w-100">
                                            <span class="input-group-btn">
                                                <button class="btn btn-minuse border border-3" type="button">-</button>
                                            </span>
                                            <input type="text" class="p-0 text-center border border-3 quantity form-control" maxlength="3" value="${currentStorage[i][1]}" disable onselectstart="return false;" onmousedown="return false;">
                                            <span class="input-group-btn">
                                                <button class="btn btn-pluss border border-3" type="button">+</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                `
                            cartSection[0].appendChild(div);
                        }
                    }
                }
            <?php endif; ?>
        <?php endforeach; ?>
        document.getElementsByClassName("price-value")[0].textContent = String(totalPayment) + "$";
        document.getElementsByClassName("total-payment")[0].textContent = String(totalPayment + 20) + "$";
        document.getElementsByClassName("hidden-data")[0].value = JSON.stringify(currentStorage);
    }
    getProductFromCart();
    addAndremoveQty();
</script>

</html>