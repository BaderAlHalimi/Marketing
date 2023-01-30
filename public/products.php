<?php
session_start();
include '../db.php';
include 'include/init.php';
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">
    <title>Shopi</title>
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
    <!--=== All Plugins CSS ===-->
    <link href="assets/css/plugins.css" rel="stylesheet">
    <!--=== All Vendor CSS ===-->
    <link href="assets/css/vendor.css" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Modernizer JS -->
    <script src="assets/js/modernizr-2.8.3.min.js"></script>
    <style>
        body {
            background-color: #f3f3f3;
        }

        #sub {
            color: black;
        }

        #sub:hover {
            color: orange;
        }

        .hov-div-item:hover p {
            color: green;
        }

        .hov-div-item p {
            transition: color 0.5s;
        }

        #supercat:hover {
            color: blue;
        }

        #supercat {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -ms-user-select: none;
            -moz-user-select: none;
        }

        .subcat {
            display: none;
        }

        .super:hover div {
            display: block;
        }
    </style>


    <!--[if lt IE 9]>
<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- Start Header Area -->
    <header class="header-area">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block">
            <!-- header top start -->
            <div class="header-top theme-bg">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="welcome-message">
                                <p>Welcome to Juan online store</p>
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="header-top-settings">
                                <ul class="nav align-items-center justify-content-end">
                                    <li class="curreny-wrap">
                                        $ Dollar (US)
                                        <i class="fa fa-angle-down"></i>
                                        <ul class="dropdown-list curreny-list">
                                            <li><a href="#">$ usd</a></li>
                                            <li><a href="#"> € EURO</a></li>
                                        </ul>
                                    </li>
                                    <li class="language">
                                        <img src="assets/img/icon/en.png" alt="flag"> English
                                        <i class="fa fa-angle-down"></i>
                                        <ul class="dropdown-list">
                                            <li><a href="#"><img src="assets/img/icon/en.png" alt="flag"> english</a></li>
                                            <li><a href="#"><img src="assets/img/icon/fr.png" alt="flag"> french</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header top end -->

            <!-- header middle area start -->
            <div class="header-main-area sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">
                        <!-- start logo area -->
                        <div class="col-lg-2">
                            <div class="logo">
                                <a href="index.php">
                                    <img src="assets/img/logo/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->

                        <!-- main menu area start -->
                        <div class="col-lg-8 position-static">
                            <div class="main-menu-area">
                                <div class="main-menu">
                                    <!-- main menu navbar start -->
                                    <nav class="desktop-menu">
                                        <ul>
                                            <li class="active"><a href="index.php">Home</i></a>
                                            </li>
                                            <li><a href="products.php">Products</a></li>
                                            <li><a href="contact-us.html">Contact us</a></li>
                                        </ul>
                                    </nav>
                                    <!-- main menu navbar end -->
                                </div>
                            </div>
                        </div>
                        <!-- main menu area end -->

                        <!-- mini cart area start -->
                        <div class="col-lg-2">
                            <div class="header-configure-wrapper">
                                <div class="header-configure-area">
                                    <ul class="nav justify-content-end">
                                        <li>
                                            <a href="#" class="offcanvas-btn">
                                                <i class="ion-ios-search-strong"></i>
                                            </a>
                                        </li>
                                        <li class="user-hover">
                                            <a href="#">
                                                <i class="ion-ios-gear-outline"></i>
                                            </a>
                                            <ul class="dropdown-list">
                                                <?php if (isset($_SESSION['login'])) {
                                                    if (isset($_SESSION['id'])) {
                                                        $id = $_SESSION['id'];
                                                        $sqli = "SELECT * from users where id = $id";
                                                        $resulti = mysqli_query($con, $sqli);
                                                        $rowi = mysqli_fetch_assoc($resulti);
                                                        if ($rowi['is_admin'] == 1) {
                                                ?>
                                                            <li><a href="my_account.php">my account</a></li>
                                                            <li><a href="../admin/dashboard.php">admin dashboard</a></li>
                                                            <li><a href="../logout.php">logout</a></li>
                                                        <?php
                                                        } else {
                                                        ?> <li><a href="my_account.php">my account</a></li>
                                                            <li><a href="../logout.php">logout</a></li>
                                                        <?php
                                                        }
                                                    } else if (isset($_SESSION['google_account'])) {
                                                        $google_id = $_SESSION['google_account'];
                                                        $sqli = "SELECT * from google_accounts where id = $google_id";
                                                        $resulti = mysqli_query($con, $sqli);
                                                        $rowi = mysqli_fetch_assoc($resulti);
                                                        ?>
                                                        <li><a href="my_account.php">my account</a></li>
                                                        <li><a href="../logout.php">logout</a></li>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <li><a href="Login.php">login</a></li>
                                                    <li><a href="signup.php">register</a></li>
                                                <?php
                                                } ?>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="cart.php" class="">
                                                <i class="ion-bag"></i>
                                                <div class="notification">
                                                    <?= $cart_num ?>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- mini cart area end -->
                    </div>
                </div>
            </div>
            <!-- header middle area end -->
        </div>
        <!-- main header start -->

        <!-- mobile header start -->
        <div class="mobile-header d-lg-none d-md-block sticky">
            <!--mobile header top start -->
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="mobile-main-header">
                            <div class="mobile-logo">
                                <a href="index.php">
                                    <img src="assets/img/logo/logo.png" alt="Brand Logo">
                                </a>
                            </div>
                            <div class="mobile-menu-toggler">
                                <div class="mini-cart-wrap">
                                    <a href="cart.html">
                                        <i class="ion-bag"></i>
                                    </a>
                                </div>
                                <div class="mobile-menu-btn">
                                    <div class="off-canvas-btn">
                                        <i class="ion-navicon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile header top start -->
        </div>
        <!-- mobile header end -->
    </header>
    <!-- end Header Area -->









    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-details-inner">
                        <div class="row" style="display: inline-block; float: left; margin-right: 15px;">
                            <div style="box-shadow: 4px 4px 5px gray; padding: 10px; border-radius: 8px; background-color: white;">
                                <h3>Categories</h3>
                                <hr>
                                <?php
                                $sql = "SELECT * from categories where super_id is null";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result)) {
                                    while ($rows = mysqli_fetch_assoc($result)) {
                                        $category_id = $rows['id'];
                                ?>
                                        <div class="super">
                                            <a href="?category=<?= $rows['id'] ?>" id="supercat"><?= $rows['name'] ?><br></a>
                                            <div class="subcat">
                                                <?php $sql1 = "SELECT * from categories where super_id = $category_id";
                                                $result1 = mysqli_query($con, $sql1);
                                                if (mysqli_num_rows($result1)) {
                                                    while ($rows1 = mysqli_fetch_assoc($result1)) {
                                                ?>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;>><a id="sub" href="?sub_category=<?= $rows1['id'] ?>"><?= $rows1['name'] ?></a><br>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            if (isset($_GET['category'])) {
                                $category_id = $_GET['category'];
                                $sql = "SELECT * from items where category_id IN (SELECT id from categories where super_id = $category_id) order by num_of_sales desc";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result)) {
                                    while ($rows = mysqli_fetch_assoc($result)) {
                            ?>
                                        <div class="col-md-3 hov-div-item" style="height: 300px; margin-right: 10px; margin-bottom: 10px; box-shadow: 4px 4px 5px gray;padding: 10px; border-radius: 12px; background-color: white;">
                                            <a style="color: black;" href="product.php?id=<?= $rows['id'] ?>">

                                                <div style="text-align: center;height: 45%;">
                                                    <img style="height: 100%;" src="../uploades/<?= $rows['image'] ?>" alt="">
                                                </div>
                                                <hr>
                                                <?php
                                                if (!is_null($rows['discount']) && $rows['discount'] != 0) {
                                                ?>
                                                    <p style="font-size: larger; font-weight: bold; color: black; display: inline-block;"><del style="font-size: larger;">$ <?= $rows['price'] ?></del> >> <p id="next-price" style="font-size: medium; font-weight: bold; color: black;display: inline-block;">$<?= $rows['price'] - $rows['discount'] ?></p>
                                                    </p>
                                                <?php
                                                } else {
                                                ?>
                                                    <p style="font-size: larger; font-weight: bold; color: black;">$ <?= $rows['price'] ?></p>
                                                <?php } ?>
                                                <p style="width: 94%; max-height: 30px;overflow: hidden; display: inline-block;"><?= $rows['name'] ?></p><span style="position: relative; top:-12px">...</span> <br>
                                                <p><?= $rows['num_of_sales'] ?> sold</p>
                                                <div class="card-footer" style="border: none; margin:0;padding: 0; background-color: white; color: white;">.</div>
                                            </a>
                                        </div>

                                        <?php
                                    }
                                }
                            } else {
                                if (isset($_GET['sub_category'])) {
                                    $sub_category = $_GET['sub_category'];
                                    $sql = "SELECT * from items where category_id = $sub_category order by num_of_sales desc";
                                    $result = mysqli_query($con, $sql);
                                    if (mysqli_num_rows($result)) {
                                        while ($rows = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <div class="col-md-3 hov-div-item" style="height: 300px; margin-right: 10px; margin-bottom: 10px; box-shadow: 4px 4px 5px gray;padding: 10px; border-radius: 12px; background-color: white;">
                                                <a style="color: black;" href="product.php?id=<?= $rows['id'] ?>">

                                                    <div style="text-align: center;height: 45%;">
                                                        <img style="height: 100%;" src="../uploades/<?= $rows['image'] ?>" alt="">
                                                    </div>
                                                    <hr>
                                                    <?php
                                                    if (!is_null($rows['discount']) && $rows['discount'] != 0) {
                                                    ?>
                                                        <p style="font-size: larger; font-weight: bold; color: black; display: inline-block;"><del style="font-size: larger;">$ <?= $rows['price'] ?></del> >> <p id="next-price" style="font-size: medium; font-weight: bold; color: black;display: inline-block;">$<?= $rows['price'] - $rows['discount'] ?></p>
                                                        </p>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <p style="font-size: larger; font-weight: bold; color: black;">$ <?= $rows['price'] ?></p>
                                                    <?php } ?>
                                                    <p style="width: 94%; max-height: 30px;overflow: hidden; display: inline-block;"><?= $rows['name'] ?></p><span style="position: relative; top:-12px">...</span> <br>
                                                    <p><?= $rows['num_of_sales'] ?> sold</p>
                                                    <div class="card-footer" style="border: none; margin:0;padding: 0; background-color: white; color: white;">.</div>
                                                </a>
                                            </div>
                                        <?php
                                        }
                                    }
                                } else {
                                    $sql = "SELECT * from items order by num_of_sales desc";
                                    $result = mysqli_query($con, $sql);
                                    if (mysqli_num_rows($result)) {
                                        while ($rows = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <div class="col-md-3 hov-div-item" style="height: 300px; margin-right: 10px; margin-bottom: 10px; box-shadow: 4px 4px 5px gray;padding: 10px; border-radius: 12px; background-color: white;">
                                                <a style="color: black;" href="product.php?id=<?= $rows['id'] ?>">

                                                    <div style="text-align: center;height: 45%;">
                                                        <img style="height: 100%;" src="../uploades/<?= $rows['image'] ?>" alt="">
                                                    </div>
                                                    <hr>
                                                    <?php
                                                    if (!is_null($rows['discount']) && $rows['discount'] != 0) {
                                                    ?>
                                                        <p style="font-size: larger; font-weight: bold; color: black; display: inline-block;"><del style="font-size: larger;">$ <?= $rows['price'] ?></del> >> <p id="next-price" style="font-size: medium; font-weight: bold; color: black;display: inline-block;">$<?= $rows['price'] - $rows['discount'] ?></p>
                                                        </p>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <p style="font-size: larger; font-weight: bold; color: black;">$ <?= $rows['price'] ?></p>
                                                    <?php } ?>
                                                    <p style="width: 94%; max-height: 30px;overflow: hidden; display: inline-block;"><?= $rows['name'] ?></p><span style="position: relative; top:-12px">...</span> <br>
                                                    <p><?= $rows['num_of_sales'] ?> sold</p>
                                                    <div class="card-footer" style="border: none; margin:0;padding: 0; background-color: white; color: white;">.</div>
                                                </a>
                                            </div>
                            <?php
                                        }
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <br><br>








    <br><br><br><br>

    <!-- Start Footer Area Wrapper -->
    <footer class="footer-wrapper">
        <!-- footer main area start -->
        <div class="footer-widget-area section-padding">
            <div class="container">
                <div class="row mtn-40">
                    <!-- footer widget item start -->
                    <div class="col-xl-5 col-lg-3 col-md-6">
                        <div class="widget-item mt-40">
                            <h5 class="widget-title">My Account</h5>
                            <div class="widget-body">
                                <ul class="location-wrap">
                                    <li><i class="ion-ios-location-outline"></i>184 Main Rd E, St Albans VIC 3021, Australia</li>
                                    <li><i class="ion-ios-email-outline"></i>Mail Us: <a href="mailto:yourmail@gmail.com">yourmail@gmail.com</a></li>
                                    <li><i class="ion-ios-telephone-outline"></i>Phone: <a href="+0025425456554">+ 00 254 254565</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- footer widget item end -->

                    <!-- footer widget item start -->
                    <div class="col-xl-2 col-lg-3 col-md-6">
                        <div class="widget-item mt-40">
                            <h5 class="widget-title">Categories</h5>
                            <div class="widget-body">
                                <ul class="useful-link">
                                    <li><a href="#">Ecommerce</a></li>
                                    <li><a href="#">Shopify</a></li>
                                    <li><a href="#">Prestashop</a></li>
                                    <li><a href="#">Opencart</a></li>
                                    <li><a href="#">Magento</a></li>
                                    <li><a href="#">Jigoshop</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- footer widget item end -->

                    <!-- footer widget item start -->
                    <div class="col-xl-2 col-lg-3 col-md-6">
                        <div class="widget-item mt-40">
                            <h5 class="widget-title">Information</h5>
                            <div class="widget-body">
                                <ul class="useful-link">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Returns & Exchanges</a></li>
                                    <li><a href="#">Shipping & Delivery</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- footer widget item end -->

                    <!-- footer widget item start -->
                    <div class="col-xl-2 col-lg-3 offset-xl-1 col-md-6">
                        <div class="widget-item mt-40">
                            <h5 class="widget-title">Quick Links</h5>
                            <div class="widget-body">
                                <ul class="useful-link">
                                    <li><a href="#">Store Location</a></li>
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Orders Tracking</a></li>
                                    <li><a href="#">Size Guide</a></li>
                                    <li><a href="#">Shopping Rates</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- footer widget item end -->
                </div>
            </div>
        </div>
        <!-- footer main area end -->

        <!-- footer bottom area start -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 order-2 order-md-1">
                        <div class="copyright-text text-center text-md-left">
                            <p>&copy; 2021 <b>Juan</b> Made with <i class="fa fa-heart text-danger"></i> by <a href="https://hasthemes.com/"><b>HasThemes</b></a></p>
                        </div>
                    </div>
                    <div class="col-md-6 order-1 order-md-2">
                        <div class="footer-social-link text-center text-md-right">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer bottom area end -->
    </footer>
    <!-- End Footer Area Wrapper -->

    <!-- offcanvas search form start -->
    <div class="offcanvas-search-wrapper">
        <div class="offcanvas-search-inner">
            <div class="offcanvas-close">
                <i class="ion-android-close"></i>
            </div>
            <div class="container">
                <div class="offcanvas-search-box">
                    <form class="d-flex bdr-bottom w-100">
                        <input type="text" placeholder="Search entire storage here...">
                        <button class="search-btn"><i class="ion-ios-search-strong"></i>search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- offcanvas search form end -->

    <!-- offcanvas mini cart start -->
    <div class="offcanvas-minicart-wrapper">
        <div class="minicart-inner">
            <div class="offcanvas-overlay"></div>
            <div class="minicart-inner-content">
                <div class="minicart-close">
                    <i class="ion-android-close"></i>
                </div>
                <div class="minicart-content-box">
                    <div class="minicart-item-wrapper">
                        <ul>
                            <li class="minicart-item">
                                <div class="minicart-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/img/cart/cart-1.jpg" alt="product">
                                    </a>
                                </div>
                                <div class="minicart-content">
                                    <h3 class="product-name">
                                        <a href="product-details.html">Flowers bouquet pink for all flower lovers</a>
                                    </h3>
                                    <p>
                                        <span class="cart-quantity">1 <strong>&times;</strong></span>
                                        <span class="cart-price">$100.00</span>
                                    </p>
                                </div>
                                <button class="minicart-remove"><i class="ion-android-close"></i></button>
                            </li>
                            <li class="minicart-item">
                                <div class="minicart-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/img/cart/cart-2.jpg" alt="product">
                                    </a>
                                </div>
                                <div class="minicart-content">
                                    <h3 class="product-name">
                                        <a href="product-details.html">Jasmine flowers white for all flower lovers</a>
                                    </h3>
                                    <p>
                                        <span class="cart-quantity">1 <strong>&times;</strong></span>
                                        <span class="cart-price">$80.00</span>
                                    </p>
                                </div>
                                <button class="minicart-remove"><i class="ion-android-close"></i></button>
                            </li>
                        </ul>
                    </div>

                    <div class="minicart-pricing-box">
                        <ul>
                            <li>
                                <span>sub-total</span>
                                <span><strong>$300.00</strong></span>
                            </li>
                            <li>
                                <span>Eco Tax (-2.00)</span>
                                <span><strong>$10.00</strong></span>
                            </li>
                            <li>
                                <span>VAT (20%)</span>
                                <span><strong>$60.00</strong></span>
                            </li>
                            <li class="total">
                                <span>total</span>
                                <span><strong>$370.00</strong></span>
                            </li>
                        </ul>
                    </div>

                    <div class="minicart-button">
                        <a href="cart.html"><i class="fa fa-shopping-cart"></i> view cart</a>
                        <a href="cart.html"><i class="fa fa-share"></i> checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offcanvas mini cart end -->

    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->


    <!--=======================Javascript============================-->
    <!--=== All Vendor Js ===-->
    <script src="assets/js/vendor.js"></script>
    <!--=== All Plugins Js ===-->
    <script src="assets/js/plugins.js"></script>
    <!--=== Active Js ===-->
    <script src="assets/js/active.js"></script>
</body>

</html>