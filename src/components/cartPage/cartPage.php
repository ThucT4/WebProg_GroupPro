<?php require_once('../../../server/classes/order.php') ?>
<?php require_once('../../../server/classes/product.php') ?>
<?php require_once('../../../server/readFromFile.php') ?>
<?php
$productList = readFromFile("product.txt");
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
    <main class="p-3 d-flex flex-wrap flex-column flex-md-row justify-content-between">
        <section class="col-12 col-md-3 p-4 border border-2">
            <div class="">
                <h2 class="m-0">Price Details</h2>
                <div class="py-4 my-3 border-bottom border-top border-1 d-flex flex-column fw-bold">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <p class="m-0">Price</p>
                        <span>2123$</span>
                    </div>
                    <div class="d-flex flex-row justify-content-between align-items-center mt-3">
                        <p class="m-0">Delivery Charges</p>
                        <span>20$</span>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between align-items-center fw-bold">
                    <p class="m-0">Total payment</p>
                    <span>2143$</span>
                </div>
            </div>
        </section>
        <section class="col-12 col-md-8 p-4">
            <div>
                <h2 class="w-100 border-1 border-bottom pb-4 fs-5">My Cart</h2>
                <div class="product d-flex flex-row flex-wrap mt-3 mb-4">
                    <div class="col-2 border border-secondary">
                        <img class="img-fluid w-100 h-100" src="../../../public/img/iphone.webp" alt="">
                    </div>
                    <div class="col-10 d-flex flex-row px-3 py-1">
                        <div class="col-8 d-flex flex-column">
                            <h3 class="m-0 fs-5 fw-bolder">Iphone 256GB pro max</h3>
                            <small class="p-0"> Sell by Minh</small>
                            <p class="fw-bold fs-4 my-2">$1377</p>
                            <div class="d-flex flex-row">
                                <button class="btn btn-warning p-2">Save for later</button>
                                <button class="btn btn-danger p-2 ms-4">Remove</button>
                            </div>
                        </div>
                        <div class="col-4 d-flex align-items-center">
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
        </section>
    </main>
    <!-- <div class="page">
        <main class="content">
            <div class="title">My Cart</div>

            <div class="cart-container">
                <table class="item-table">
                    <tr class="item-row">
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>

                    <tr>
                        <td class="img-col">
                            <img src="https://cdn2.cellphones.com.vn/358x/media/catalog/product/i/p/ip13-pro_2.jpg" alt="product image">
                        </td>

                        <td class="name-col text-wrap">
                            <p>this is an iphone</p>
                        </td>

                        <td class="price-col">
                            $1000
                        </td>

                        <td class="quantity-col">
                            <a class="input" href="#">-</a>
                            <a href="#" class="quantity">1</a>
                            <a class="input" href="#">+</a>
                            <div>
                                <button class="remove">Remove</button>
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td class="img-col">
                            <img src="https://www.nguyenkim.com/images/detailed/757/10050188-laptop-hp-240-g8-i5-1135g7-518w3pa.jpg" alt="product image">
                        </td>

                        <td class="name-col text-wrap">
                            <p>this is a laptop</p>
                        </td>

                        <td class="price-col">
                            $1200
                        </td>

                        <td class="quantity-col">
                            <a class="input" href="#">-</a>
                            <a href="#" class="quantity">1</a>
                            <a class="input" href="#">+</a>
                            <div>
                                <button class="remove">Remove</button>
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td class="img-col">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTgGupBfa_jjJZX8-LPo6SkKfz_P1BQ-WAcRg&usqp=CAU" alt="product image">
                        </td>

                        <td class="name-col text-wrap">
                            <p>this is a shirt</p>
                        </td>

                        <td class="price-col">
                            $30
                        </td>

                        <td class="quantity-col">
                            <a class="input" href="#">-</a>
                            <a href="#" class="quantity">1</a>
                            <a class="input" href="#">+</a>
                            <div>
                                <button class="remove">Remove</button>
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td class="img-col">
                            <img src="https://cdn.tgdd.vn/Files/2020/10/02/1295545/samsung-galaxy-tab-s7-_800x533.jpg" alt="product image">
                        </td>

                        <td class="name-col text-wrap">
                            <p>this is a tablet</p>
                        </td>

                        <td class="price-col">
                            $1000
                        </td>

                        <td class="quantity-col">
                            <a class="input" href="#">-</a>
                            <a href="#" class="quantity">1</a>
                            <a class="input" href="#">+</a>
                            <div>
                                <button class="remove">Remove</button>
                            </div>

                        </td>

                    </tr>

                </table>
            </div>
        </main>

        <aside class="sidebar ">
            <h1 class="text-center" style="font-size: 25px;">Order Details</h1>

            <table class="details-table" style="height:100px">
                <tr>
                    <th>Price</th>
                    <td>10$</td>
                </tr>

                <tr>
                    <th>Delivery</th>
                    <td>10$</td>
                </tr>

                <tr>
                    <th>Total payable</th>
                    <td>20$</td>
                </tr>
            </table>

        </aside>
    </div> -->


    <footer>
        <?php
        require_once('../footer/footer.html')
        ?>
    </footer>
</body>

<script src="/src/assets/scripts/cartPage.js"></script>
<script>
    var minus = document.getElementsByClassName('btn-minuse');
    var plus = document.getElementsByClassName('btn-pluss');
    for (let i = 0; i < minus.length; i++) {
        minus[i].addEventListener('click', function() {
            if (minus[i].closest("span").nextElementSibling.value > 1) {
                minus[i].closest("span").nextElementSibling.value = parseInt(minus[i].closest("span").nextElementSibling.value) - 1
            }
        })
        plus[i].addEventListener('click', function() {
            plus[i].closest("span").previousElementSibling.value = parseInt(plus[i].closest("span").previousElementSibling.value) + 1
        })

    }
</script>

<script>
    function getProductFromCart() {
        <?php foreach ($productList as $product) : ?>
            <?php if (!empty($product)) : ?>
                var currentStorage = JSON.parse(localStorage.getItem("cart"));
                if (currentStorage.length == 0) {
                    return;
                } else {
                    for (let i = 0; i < currentStorage.length; i++) {
                        if (currentStorage[i][0] == "<?php echo $product->productID; ?>") {
                            console.log(currentStorage[i]);
                        }
                    }
                }
            <?php endif; ?>
        <?php endforeach; ?>
    }
    getProductFromCart();
</script>

</html>