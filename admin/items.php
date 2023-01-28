<?php
$pageTitle = 'Items';
include 'include/header.php';
include 'include/sidebar.php';
include '../db.php';

$remove_id = "non";
if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];
}
if ($remove_id != "non") {
    $sql1 = "UPDATE items set is_delete = 1 where id = $remove_id";
    mysqli_query($con, $sql1);
    $msg = 'Delete Succeed!';
}

$user_id = $_SESSION['id'];
$sql = "SELECT * from items where user_id=$user_id and is_delete = 0";
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
                        <li class="breadcrumb-item"><a href="#">Items</a></li>
                        <li class="breadcrumb-item active">Fixed Layout</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="item_control.php" class="btn btn-primary">Add Item</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Your Items</h3>
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
                                                <center>id</center>
                                            </th>
                                            <th style="width: 200px;padding:10px 20px;">
                                                <center>image</center>
                                            </th>
                                            <th style="width: 200px;padding:10px 20px;">
                                                <center>name</center>
                                            </th>
                                            <th style="width: 200px;padding:10px 20px;">
                                                <center>details</center>
                                            </th>
                                            <th style="width: 200px;padding:10px 20px;">
                                                <center>quantity</center>
                                            </th>
                                            <th style="width: 200px;padding:10px 20px;">
                                                <center>price</center>
                                            </th>
                                            <th style="width: 200px;padding:10px 20px;">
                                                <center>discount</center>
                                            </th>
                                            <th style="width: 60px;">
                                                <center>edit</center>
                                            </th>
                                            <th style="width: 60px;">
                                                <center>remove</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($rows = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td class="text-center"> <?= $rows['id'] ?></td>
                                                <td class="text-center"> <img style="width: 150px;" src="../uploades/<?= $rows['image'] ?>" alt="item image"></td>
                                                <td class="text-center"><?= $rows['name'] ?></td>
                                                <td class="text-center"><?= $rows['details'] ?></td>
                                                <td class="text-center"><?= $rows['quantity'] ?></td>
                                                <td class="text-center"r style="color: green; font-weight: bold;font-size: larger;"><?= $rows['price'] ?> $</td>
                                                <td class="text-center"r style="color: green; font-weight: bold;font-size: larger;"><?php if(!is_null($rows['discount'])){echo $rows['discount'];}else{echo 0;} ?> $</td>
                                                <td class="text-center"><a href="item_control.php?edit_id=<?= $rows['id'] ?>">
                                                        <li style="color: black; font-size: x-large;" class="nav-icon fas fa-edit"></li>
                                                    </a></td>
                                                <td class="text-center"><a href="?remove_id=<?= $rows['id'] ?>" onclick="return confirm('Are you sure, you need to remove <?= $rows['name'] ?>')">
                                                        <li style="color: black; font-size: x-large;" class="nav-icon fas fa-trash"></li>
                                                    </a></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table><?php
                                    } else {
                                        ?> <p>side of items shown</p> <?php }
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