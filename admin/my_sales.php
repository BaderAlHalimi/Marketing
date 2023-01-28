<?php
$pageTitle = 'my Sales';
include 'include/header.php';
include 'include/sidebar.php';
include '../db.php';
require_once '../phpMailer/mail.php';

$remove_id = "non";
if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];
}
if ($remove_id != "non") {
    $sql1 = "UPDATE invoice set is_delete = 1 where invoice_id = $remove_id";
    mysqli_query($con, $sql1);
    $sql1 = "UPDATE items set quantity = quantity + (SELECT quantity from invoice where invoice_id = $remove_id), num_of_sales = num_of_sales - (SELECT quantity from invoice where invoice_id = $remove_id) where id = (SELECT item_id from invoice where invoice_id = $remove_id)";
    mysqli_query($con, $sql1);

    $sql = "SELECT * from items where id = (SELECT item_id from invoice where invoice_id = $remove_id)";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $sql1 = "SELECT * from checkout where id = (SELECT checkout_id from invoice where invoice_id = $remove_id)";
    $result1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($result1);

    $mail->setFrom('badermarket7@gmail.com', 'Market Bader');
    $mail->addAddress((string)$row1['email']);               //Name is optional
    $mail->Subject = 'The shipment was rejected!';
    $mail->Body    = '
    <div>
        <div style="padding: 2% 4%; background: linear-gradient(to right,orange,rgb(255, 242, 0));text-align: left;">
            <h1 style="color: white; font-size: 300%;text-shadow: 0px 2px 5px black;">Bader Market</h1>
        </div>
        <div>
            <h3>قام البائع برفض عملية الشراء الخاصة بك</h3>
            اسم المنتج: ' . $row['name'] . '<br/>
            السعر المنتج: ' . ($row['price'] - $row['discount']) . '$</br>
            <p style="color: red; font-size: large; font-weight: bold;">غالباً ما يتم رفض المنتج إذا كانت بينات الشحن غير صحيحة أو المنطقة المدخلة غير مدعومة</p>
            عنوان الشحن:<br/>
            <p>' . $row1['country'] . ' > ' . $row1['city'] . ' > ' . $row1['street'] . '</p>
        </div>
    </div>';
    $mail->send();
    $msg = 'Delete Succeed!';
}
$is_delivered = "non";
if (isset($_GET['is_delivered'])) {
    $is_delivered = $_GET['is_delivered'];
}
if ($is_delivered != "non") {
    $sql1 = "UPDATE invoice set is_delivered = 1 where invoice_id = $is_delivered";
    mysqli_query($con, $sql1);
    $sql = "SELECT * from items where id = (SELECT item_id from invoice where invoice_id = $is_delivered)";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $sql1 = "SELECT * from checkout where id = (SELECT checkout_id from invoice where invoice_id = $is_delivered)";
    $result1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($result1);

    $mail->setFrom('badermarket7@gmail.com', 'Market Bader');
    $mail->addAddress((string)$row1['email']);               //Name is optional
    $mail->Subject = 'The product has been shipped!';
    $mail->Body    = '<div>
        <div style="padding: 2% 4%; background: linear-gradient(to right,orange,rgb(255, 242, 0));text-align: left;">
            <h1 style="color: white; font-size: 300%;text-shadow: 0px 2px 5px black;">Bader Market</h1>
        </div>
        <div>
            <h3>تم شحن المنتج بنجاح</h3>
            <p>اسم المنتج: ' . $row['name'] . '</p>
            <p>سعر المنتج: ' . ($row['price'] - $row['discount']) . '$</p>
            <p style="color: green; font-size: large; font-weight: bold;">المنتج يصل خلال 2 ساعة إلى 5 ساعات</p>
            <p>عنوان الشحن: </p>
            <p>' . $row1['country'] . ' > ' . $row1['city'] . ' > ' . $row1['street'] . '</p>
        </div>
    </div>';
    $mail->send();
    $msg = 'Delivered Succeed!';
}

$user_id = $_SESSION['id'];
$sql = "SELECT * from invoice where item_id in (SELECT id from items where user_id = $user_id)  and is_delete = 0 and done = 1 and is_delivered = 0";
$result = mysqli_query($con, $sql);
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $pageTitle ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">sales</a></li>
                        <li class="breadcrumb-item active">Fixed Layout</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Your Sales</h3>
                        </div>
                        <div class="card-body">
                            <?php if (isset($msg)) { ?>
                                <div class="alert alert-success"><?= $msg ?></div>
                            <?php } ?>
                            <?php if (mysqli_num_rows($result)) {
                            ?>
                                <table class="col-md-12" border="1px">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;padding:10px 20px;">
                                                <center>invoice_id</center>
                                            </th>
                                            <th style="width: 200px;padding:10px 20px;">
                                                <center>item name</center>
                                            </th>
                                            <th style="width: 200px;padding:10px 20px;">
                                                <center>item image</center>
                                            </th>
                                            <th style="width: 200px;padding:10px 20px;">
                                                <center>date_adding</center>
                                            </th>
                                            <th style="width: 200px;padding:10px 20px;">
                                                <center>quantity</center>
                                            </th>
                                            <th style="width: 200px;padding:10px 20px;">
                                                <center>price</center>
                                            </th>
                                            <th style="width: 200px;padding:10px 20px;">
                                                <center>checkout_id</center>
                                            </th>
                                            <th style="width: 60px;">
                                                <center>deliverd</center>
                                            </th>
                                            <th style="width: 60px;">
                                                <center>reject</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($rows = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td class="text-center"> <?= $rows['invoice_id'] ?></td>
                                                <td class="text-center"><img style="width: 50%;" src="../uploades/<?php
                                                                                                                    $item_id = $rows['item_id'];
                                                                                                                    $sqlitem = "SELECT * from items where id = $item_id";
                                                                                                                    $resultitem = mysqli_query($con, $sqlitem);
                                                                                                                    $rowitem = mysqli_fetch_assoc($resultitem);
                                                                                                                    echo $rowitem['image'];
                                                                                                                    ?>?>" alt=""></td>
                                                <td class="text-center"><?= $rowitem['name'] ?></td>
                                                <td class="text-center"><?= $rows['date_adding'] ?></td>
                                                <td class="text-center"><?= $rows['quantity'] ?></td>
                                                <td class="text-center" style="color: green; font-weight: bold;font-size: larger;"><?= ($rowitem['price'] - $rowitem['discount']) * $rows['quantity'] ?> $</td>
                                                <td class="text-center"><a href="checkout.php?checkout_id=<?= $rows['checkout_id'] ?>"><?= $rows['checkout_id'] ?></a></td>
                                                <td class="text-center"><a href="?is_delivered=<?= $rows['invoice_id'] ?>">
                                                        <li style="color: black; font-size: x-large;" class="nav-icon fa-solid fas fa-truck"></li>
                                                    </a></td>
                                                <td class="text-center"><a href="?remove_id=<?= $rows['invoice_id'] ?>" onclick="return confirm('Are you sure, you need to remove <?= $rowitem['name'] ?>')">
                                                        <li style="color: black; font-size: x-large;" class="nav-icon fas fa-trash"></li>
                                                    </a></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table><?php
                                    } else {
                                        ?> <p>side of sales shown</p> <?php }
                                                                        ?>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Done!
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<?php
include 'include/footer.php';
?>