<?php
session_start();
include '../db.php';
include 'include/init.php';



require_once('../PHP-Translate-using-Google-Translator-API-master/vendor/autoload.php');

use \Statickidz\GoogleTranslate;

$source = 'en';
$target = 'ar';





$msg;
$msg1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'include/header.php';
    $item_id = $_GET['id'];
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
    } else {
        $gaccount_id = $_SESSION['google_account'];
    }
    $quantity = $_POST['quantity'];
    if (!is_null($quantity) && $quantity > 0) {
        $date = date('Y-m-d h:i:s');
        $sql;
        if (isset($_SESSION['id'])) {
            $sql = "INSERT INTO invoice (user_id,item_id,date_adding,quantity) values ($user_id,$item_id,'$date',$quantity)";
        } else if (isset($_SESSION['google_account'])) {
            $sql = "INSERT INTO invoice (gaccount_id,item_id,date_adding,quantity) values ($gaccount_id,$item_id,'$date',$quantity)";
        }
        mysqli_query($con, $sql);
        $msg1 = 'Added to cart successfully!';
    } else {
        $msg = 'Enter Quantity >0';
    }
}
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








    <?php
    if (isset($_GET['id'])) {
        $item_id = $_GET['id'];
        $sql = "SELECT * from items where id = $item_id and is_delete = 0";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
    ?>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product-details-inner">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="product-large-slider mb-20">
                                            <div class="pro-large-img img-zoom">
                                                <img src="../uploades/<?= $row['image'] ?>" alt="product thumb" />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-7">
                                        <div class="product-details-des">
                                            <?php
                                            if (isset($msg)) {
                                            ?>
                                                <div style="background-color: #dc3545; color: white; padding: 10px 20px;font-size:larger;border-radius: 8px;" class="msg"><?= $msg ?></div><br>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if (isset($msg1)) {
                                            ?>
                                                <div style="background-color: green; color: white; padding: 10px 20px;font-size:larger;border-radius: 8px;" class="msg"><?= $msg1 ?></div><br>
                                            <?php
                                            }
                                            ?>
                                            <h3 class="pro-det-title"><?= $row['name'] ?></h3>
                                            <div class="price-box">
                                                <?php if ($row['discount'] > 0.0) {
                                                ?>
                                                    <span style="color: green;font-weight: bold;" class="regular-price">$<?= $row['price'] - $row['discount'] ?></span>
                                                    <span class="old-price"><del>$<?= $row['price'] ?></del></span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="regular-price">$ <?= $row['price'] ?></span>
                                                <?php
                                                } ?>

                                            </div><br>
                                            <div class="d-flex align-items-center mb-20">
                                                <form action="#" method="post">
                                                    <div style="display: inline-block;"><input name="quantity" style="height: 46px;" type="number" value="<?php if ($row['quantity'] > 0) {
                                                                                                                                                                echo 1;
                                                                                                                                                            } else {
                                                                                                                                                                echo 0;
                                                                                                                                                            } ?>" max="<?= $row['quantity'] ?>"></div>
                                                    <input class="btn btn-default" type="submit" style="float: right;" value="Add To Cart">
                                                </form>
                                            </div>
                                            <div class="availability mb-20">
                                                <h5 class="cat-title">Availability:</h5>
                                                <?php if ($row['quantity'] > 0) {
                                                ?>
                                                    <span>In Stock, Quantity: <?= $row['quantity'] ?></span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span style="color: red;">not avilable</span>
                                                <?php
                                                } ?>
                                            </div>
                                            <?php
                                            $text_to_speach = $row['details'];
                                            $text = array();
                                            $speech = array();
                                            do {
                                                try {
                                                    $len = strpos($text_to_speach, "\n", 0);
                                                    if ($len == false || $len > 190) {
                                                        $len = 190;
                                                    }
                                                } catch (Exception) {
                                                    $len = 190;
                                                }
                                                $text[] = substr($text_to_speach, 0, $len);
                                                $text_to_speach = substr($text_to_speach, $len, strlen($text_to_speach));
                                            } while (strlen($text_to_speach) > 5);
                                            for ($i = 0; $i < count($text); $i++) {
                                                $text[$i] = str_replace(array("\r\n", "\n", "\r", "<br>", "<br/>", "/", "(", ")"), " ", $text[$i]);
                                                $text[$i] = str_replace(array("'", ":", "-", "*", "·", ".", ",", "!", "&"), "", $text[$i]);
                                                $text[$i] = nl2br($text[$i]);
                                                $text[$i] = trim($text[$i]);
                                                $text[$i] = urlencode($text[$i]);
                                                $speech[] = file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q=' . $text[$i] . '&tl=en-IN');
                                            }
                                            ?>
                                            <audio id='audioPlayer' controls='controls' autoplay>
                                                <source src='data:audio/mpeg;base64,<?php foreach ($speech as $value) {
                                                                                        echo base64_encode($value);
                                                                                    } ?>'>
                                            </audio>

                                            <h5>English:</h5>
                                            <textarea disabled id="textBox1" name="content" TextMode="MultiLine" onkeyup="setHeight('textBox1');" onkeydown="setHeight('textBox1');" style="width: 100%;resize: none;background: none; border: none; overflow-y: hidden;"><?= $row['details'] ?></textarea>
                                            <?php
                                            $text = $row['details'];

                                            $trans = new GoogleTranslate();
                                            $trans_result = $trans->translate($source, $target, $text);
                                            ?>
                                            <br><br><br>
                                            <h5>عربي:</h5>
                                            <textarea disabled id="textBox2" name="content" TextMode="MultiLine" onkeyup="setHeight('textBox2');" onkeydown="setHeight('textBox2');" style="width: 100%;resize: none;background: none; border: none; overflow-y: hidden;"><?= $trans_result?></textarea>
                                            <br><br>
                                            <!--JAVASCRIPT-->
                                            <script type="text/javascript">
                                                function setHeight(fieldId) {
                                                    document.getElementById(fieldId).style.height = document.getElementById(fieldId).scrollHeight + 'px';
                                                }
                                                setHeight('textBox1');
                                                setHeight('textBox2');
                                            </script>

                                            <div class="share-icon">
                                                <h5 class="cat-title">Share:</h5>
                                                <a href="#"><i class="fa fa-facebook"></i></a>
                                                <a href="#"><i class="fa fa-twitter"></i></a>
                                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
    <?php
        }
    }
    ?>

    <br><br>










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