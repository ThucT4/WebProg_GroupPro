<?php
function customerHeader1()
{
    echo <<<CODE
        <div class="navbar navbar-expand-md navbar-light d-md-block d-none">
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav fs-5">
                        <li class="nav-item">
                            <a class="nav-link text-light px-3" href="../mainPage/mainPage.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light px-3" href="../cartPage/cartPage.php">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light px-3" href="../customerAccountPage/customerAccountPage.php">My account</a>
                        </li>
                    </ul>
                </div>
            </div>
        CODE;
}

function customerHeader2()
{
    echo <<<CODE
        <div class="col-8 navbar navbar-light d-md-none d-flex align-items-center p-0">
            <div class="justify-content-center" id="navbarNav">
                <ul class="navbar-nav fs-5 d-flex flex-wrap flex-row justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link text-light px-3" href="../mainPage/mainPage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light px-3" href="../cartPage/cartPage.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light px-3" href="../customerAccountPage/customerAccountPage.php">My account</a>
                    </li>
                </ul>
            </div>
        </div>
        CODE;
}

function vendorHeader1()
{
    echo <<<CODE
        <div class="col-6 navbar navbar-light d-flex align-items-center justify-content-around p-0">
            <div class="justify-content-center" id="navbarNav">
                <ul class="navbar-nav fs-5 d-flex flex-wrap flex-row justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link text-light px-3" href="../mainPage/mainPage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light px-3" href="../cartPage/cartPage.php">Cart</a>
                    </li>
                </ul>
            </div>
        </div>
        CODE;
}
function shipperHeader2()
{
}

function renderHeaderNav()
{
    if (isset($_SESSION['user'])) {
        if ($_SESSION['accounttype'] == 'customer') {
            customerHeader1();
        }
        if ($_SESSION['accounttype'] == 'vendor') {
            vendorHeader1();
        }
    }
}

function renderResHeaderNav()
{
    if (isset($_SESSION['user'])) {
        if ($_SESSION['accounttype'] == 'customer') {
            customerHeader2();
        }
    }
}
