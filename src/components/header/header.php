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
    <header>
        <div class="d-flex flex-column" style="background-color: #60b466;">
            <div class="d-flex flex-row align-items-center justify-content-between px-4">
                <div class="d-flex flex-row col-8 col-md-4 justify-content-center">
                    <div class="slogan navbar-text text-light text-center fs-5">
                        Find everything with All-in-cart online store
                    </div>
                </div>
                <div class="navbar navbar-expand-md navbar-light d-md-block d-none">
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                        <ul class="navbar-nav fs-5">
                            <li class="nav-item">
                                <a class="nav-link text-light px-3" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light px-3" href="#">Features</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light px-3" href="#">Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light px-3" href="#">Disabled</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex">
                    <?php
                    session_start();
                    if (!isset($_SESSION['user'])) {
                        echo <<<CODE
                                <div class="d-grid gap-2 d-md-block d-flex flex-sm-row flex-column">
                                    <button class="btn text-white" type="button" style="background-color: #60b466;">Register</button>
                                    <button class="btn text-white" type="button" style="background-color: #60b466;">Login</button>
                                </div>
                        CODE;
                    } else {
                        $now = time(); // Checking the time now when home page starts.
                        if ($now > $_SESSION['expire']) {
                            session_destroy();
                            echo "Your session has expired! <a href='http://localhost/somefolder/login.php'>Login here</a>";
                        } else {
                            $username = $_SESSION['user'];
                            echo <<<CODE
                                <div class="d-grid gap-2 d-md-block d-flex flex-row justify-content-center align-items-center">
                                <a href="#">
                                    <button class="btn text-white" href="#" type="button" style="background-color: #60b466;">$username</button>
                                </a>
                                <button class="btn text-white" type="button" style="background-color: #60b466;">Login</button>
                                </div>
                            CODE;
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="navbar navbar-expand-md navbar-light d-flex flex-row flex-wrap justify-content-between p-3 px-lg-4">
                <div class="col-12 col-md-1 d-flex flex-row">
                    <a class="navbar-brand text-center w-100" href="#">
                        <img src="/public/img/logo.png" width="80" height="80" class="d-inline-block align-top rounded" alt="Website logo">
                    </a>
                    <div class="col-8 navbar navbar-light d-md-none d-flex align-items-center p-0">
                        <div class="justify-content-center" id="navbarNav">
                            <ul class="navbar-nav fs-5 d-flex flex-wrap flex-row justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link text-light px-3" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light px-3" href="#">Features</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light px-3" href="#">Pricing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light px-3" href="#">Disabled</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-md-6 my-2 my-md-0">
                    <div class="d-flex justify-content-md-center align-items-center">
                        <div class="col-12">
                            <div class="search">
                                <img src="../../../public/img/search-icon.png" alt="Search icon">
                                <input type="text" class="form-control" placeholder="Have a question? Ask Now">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" class="col-2 col-md-2 shop-icon d-flex justify-content-center">
                    <div class="position-relative">
                        <img src="../../../public/img/add-to-cart-white.png" alt="add to cart icon">
                        <span class="position-absolute top-100 translate-middle badge rounded-pill bg-danger cart-size">
                            0
                        </span>
                    </div>
                </a>
            </div>

        </div>
    </header>
</body>
<script>
    console.log("asdasd");
    window.addEventListener("storage", () => {
        console.log("asdasdkkk");
        if (localStorage.getItem("cart") !== null) {
            var sizeOfCart = JSON.parse(localStorage.getItem("cart")).length;
            document.getElementsByClassName("cart-size")[0].value = sizeOfCart;
        }
    });
</script>

</html>