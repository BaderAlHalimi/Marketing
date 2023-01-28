<?php
$pageTitle = 'Checkout Details';
include 'include/header.php';
include 'include/sidebar.php';
include '../db.php';

if (isset($_GET['checkout_id'])) {
    $checkout_id = $_GET['checkout_id'];
    $user_id = $_SESSION['id'];
    $sql = "SELECT * from checkout where id = $checkout_id";
    $result = mysqli_query($con, $sql);
    $rows = mysqli_fetch_assoc($result);
    if (!mysqli_num_rows($result)) {
        header('location:my_sales.php');
        exit;
    }
}

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
                        <li class="breadcrumb-item"><a href="#">Checkout</a></li>
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
                            <h3 class="card-title">Checkout</h3>
                        </div>
                        <div class="card-body">
                            <?php if (isset($msg)) { ?>
                                <div class="alert alert-success"><?= $msg ?></div>
                            <?php } ?>
                            <table class="col-md-12" border="1px">
                                <tbody>
                                    <tr class="text-center">
                                        <th style="width: 50px;padding: 2%;">
                                            <center>id</center>
                                        </th>
                                        <th style="width: 50px;padding:10px 20px;">
                                            <?= $rows['id'] ?>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="width: 200px;padding: 2%;">
                                            <center>name</center>
                                        </th>
                                        <th style="width: 200px;padding:10px 20px;">
                                            <?= $rows['firstname'] . " " . $rows['lastname'] ?>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="width: 200px;padding: 2%;">
                                            <center>email</center>
                                        </th>
                                        <th style="width: 200px;padding:10px 20px;">
                                            <?= $rows['email'] ?>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="width: 200px;padding: 2%;">
                                            <center>country</center>
                                        </th>
                                        <th style="width: 200px;padding:10px 20px;">
                                            <?= $rows['country'] ?>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="width: 200px;padding: 2%;">
                                            <center>street</center>
                                        </th>
                                        <th style="width: 200px;padding:10px 20px;">
                                            <?= $rows['street'] ?>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="width: 200px;padding: 2%;">
                                            <center>city</center>
                                        </th>
                                        <th style="width: 200px;padding:10px 20px;">
                                            <?= $rows['city'] ?>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="width: 60px;padding: 2%;">
                                            <center>postalCode</center>
                                        </th>
                                        <th style="width: 60px;">
                                            <?= $rows['postalCode'] ?>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="width: 60px;padding: 2%;">
                                            <center>phone</center>
                                        </th>
                                        <th style="width: 60px;">
                                            <?= $rows['phone'] ?>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="width: 30%; padding: 2%;">
                                            <center>ordernote</center>
                                        </th>
                                        <th style="width: 60px;">
                                            <?= $rows['ordernote'] ?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
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