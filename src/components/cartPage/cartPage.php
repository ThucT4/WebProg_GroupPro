<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart Page</title>
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/src/assets/styles/cartPage.css" />

</head>


<body>
    <header>
        <?php
        require_once('../header/header.php')
        ?>
    </header>

    <div class="page">
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
    </div>


    <footer>
        <?php
        require_once('../footer/footer.html')
        ?>
    </footer>
</body>

<script src="/src/assets/scripts/cartPage.js"></script>

</html>