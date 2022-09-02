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
            <div class="d-flex flex-row px-4">
                <div class="slogan navbar-text text-light text-center fs-5">
                    Find everything with All-in-cart online store
                </div>
            </div>
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
            <div>
                <?php
                session_start();
                // if (isset($_SESSION('user'))) {

                // }
                ?>
            </div>
            <div class="navbar navbar-expand-md navbar-light d-flex flex-row flex-wrap justify-content-between px-lg-4">
                <a class="navbar-brand" href="#">
                    <img src="/public/img/logo.png" width="80" height="80" class="d-inline-block align-top rounded" alt="Website logo">
                </a>
                <div class="col-6">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="col-md-12">
                            <div class="search">
                                <img src="../../../public/img/search-icon.png" alt="Search icon">
                                <input type="text" class="form-control" placeholder="Have a question? Ask Now">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="col-2 shop-icon text-center">
                    <img src="../../../public/img/add-to-cart.png" alt="add to cart icon">
                </span>
            </div>

        </div>
    </header>
</body>


</html>