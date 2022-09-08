<?php session_start() ?>
<?php require_once('../header/headerNav.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/src/assets/styles/header.css?v=<?php echo time(); ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');
    </style>
</head>

<body>
    <?php
    if (!isset($_SESSION['user'])) {
        header("Refresh:0; url=../loginPage/login.php");
    }
    ?>
    <div class="d-flex flex-column" style="background-color: #60b466;">
        <?php
        if (isset($_SESSION['user'])) {
            if ($_SESSION['accounttype'] == 'customer') {
                echo <<<CODE
                            <div class="d-flex flex-wrap flex-row align-items-center justify-content-between px-4">
                                <div class="d-flex flex-row col-12 col-md-4 justify-content-center">
                                    <div class="slogan navbar-text text-light text-center fs-5">
                                        Find everything with All-in-cart online store
                                    </div>
                                </div>
                        CODE;
                renderHeaderNav();
            } else {
                echo <<<CODE
                        <div class="d-flex flex-wrap flex-row align-items-center justify-content-between p-4">
                            <div class="col-12 col-md-5 d-flex flex-row align-items-center justify-content-between">
                                <a class="text-center" href="../vendorPage/vendorPage.php">
                                    <img src="/public/img/logo.png" width="80" height="80" class="d-inline-block align-top rounded" alt="Website logo">
                                </a>
                                <div class="d-flex flex-row col-8 col-md-4 justify-content-center flex-grow-1">
                                    <div class="slogan navbar-text text-light text-center fs-5 w-100">
                                        Find everything with All-in-cart online store
                                    </div>
                                </div>
                            </div>            
                    CODE;
                if (($_SESSION['accounttype'] == 'vendor')) {
                    echo <<<CODE
                            <div class="col-12 col-md-4 navbar navbar-light d-flex align-items-center justify-content-center p-0">
                                <div class="justify-content-center" id="navbarNav">
                                    <ul class="navbar-nav fs-5 d-flex flex-wrap flex-row justify-content-center">
                                        <li class="nav-item">
                                            <a class="nav-link text-light px-3" href="../vendorPage/vendorPage.php"">My products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-light px-3" href="../vendorPage/vendorPage-addproduct.php">Add products</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        CODE;
                }
            }
        }
        ?>
        <div class="col-12 col-md-3 d-flex align-items-center justify-content-center">
            <?php
            if (!isset($_SESSION['user'])) {
                echo <<<CODE
                                <div class="d-grid gap-2 d-md-block d-flex flex-sm-row flex-column">
                                    <a href="../registerPage/register.php">
                                        <button class="btn text-white" type="button" style="background-color: #60b466;">Register</button>
                                    </a>
                                    <a href="../loginPage/login.php">
                                        <button class="btn text-white" type="button" style="background-color: #60b466;">Login</button>
                                    </a>
                                </div>
                        CODE;
            } else {
                $now = time(); // Checking the time now when home page starts.
                if ($now > $_SESSION['expire']) {
                    session_destroy();
                    echo "Your session has expired! <a href='loginPage/login.php'>Login here</a>";
                } else {
                    $username = $_SESSION['user'];
                    echo <<<CODE
                                <div class="d-grid gap-2 d-md-block d-flex flex-row justify-content-center align-items-center">
                                    <a href="../customerAccountPage/customerAccountPage.php">
                                        <button class="btn text-white" type="button" style="background-color: #60b466;">$username</button>
                                    </a>
                                CODE;
                    echo <<<CODE
                                    <a href='../../../server/logOut.php'>
                                        <button class="btn text-warning" style="background-color: #60b466;" type="button" onclick="localStorage.clear();">Log out</button>
                                    </a>
                                </div>
                                CODE;
                }
            }
            ?>
        </div>
    </div>
    <?php
    if (isset($_SESSION['user'])) {
        if ($_SESSION['accounttype'] == 'customer') {
            echo <<<CODE
                        <div class="navbar navbar-expand-md navbar-light d-flex flex-row flex-wrap justify-content-between p-3 px-lg-4">
                            <div class="col-12 col-md-1 d-flex flex-row">
                                <a class="navbar-brand text-center w-100" href="../mainPage/mainPage.php">
                                    <img src="/public/img/logo.png" width="80" height="80" class="d-inline-block align-top rounded" alt="Website logo">
                                </a>
                    CODE;
            renderResHeaderNav();
            echo <<<CODE
                        </div>
                        <div class="d-flex flex-row col-10 col-md-6 my-2 my-md-0">
                            <div class="d-flex justify-content-md-center align-items-center flex-grow-1">
                                <div class="col-12">
                                    <form class="search" onsubmit="navigateToSearchPage();return false">
                                        <img src="../../../public/img/search-icon.png" alt="Search icon">
                                        <input type="text" class="form-control search-input" placeholder="Search desired products">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                        <button type="button" class="btn btn-lg btn-danger ms-md-3" data-bs-toggle="popover" title="How to search ?" data-bs-content="Give the product name in the search <br/> Or price range in format 'value:value' to find appropriate products <br/> Other invalid context will be ignored" data-bs-html="true">
                            <div class="rounded-circle p-1 d-flex justify-content-center align-items-center" style="width: 35px; height: 35px;"> 
                                <img class="img-fluid w-100 h-100" src="../../../public/img/question.png" alt="Search icon">
                            </div>
                        </button>
                        </div>
                        <a href="../cartPage/cartPage.php" class="col-2 col-md-2 shop-icon d-flex justify-content-center">
                            <div class="position-relative">
                                <img src="../../../public/img/add-to-cart-white.png" alt="add to cart icon">
                                <span class="position-absolute top-100 translate-middle badge rounded-pill bg-danger cart-size">0</span>
                            </div>
                        </a>
                    </div>
                    CODE;
        }
    }
    ?>
    </div>
</body>
<script>
    var cartSize = document.getElementsByClassName("cart-size")[0];
    if (cartSize != null) {
        window.addEventListener("storage", () => {
            if (localStorage.getItem("cart") !== null) {
                var sizeOfCart = JSON.parse(localStorage.getItem("cart")).length;
                cartSize.textContent = sizeOfCart;
            }
        });
        if (localStorage.getItem("cart") !== null) {
            cartSize.textContent = JSON.parse(localStorage.getItem("cart")).length;
        }
    }
</script>
<script>
    function navigateToSearchPage() {
        var url = document.getElementsByClassName("search-input")[0].value;
        window.location.href = `../customerPage/customerPage.php?name=${url}`;
    }
</script>
<script src="../../../public/bootstrap/js/bootstrap.min.js"> </script>
<script src="../../../public/bootstrap/js/bootstrap.bundle.min.js"> </script>
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
</script>


</html>