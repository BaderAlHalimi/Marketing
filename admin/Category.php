<?php

include '../db.php';
$name;
$type;
$details;
$pageTitle = 'Add Category';
include 'include/header.php';
include 'include/sidebar.php';
$type = 'Add';
$user_id = $_SESSION['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['Category'];
    $errorForm = array();
    if (empty($name)) {
        $errorForm[] = 'name is requierd';
    }
    if ($category_id == 'non') {
        if (count($errorForm) == 0) {
            $sql = "INSERT INTO categories (name) values ('$name')";
            mysqli_query($con, $sql);
            $msg = 'add Succeed!';
            $name = '';
        }
    }else{
        if (count($errorForm) == 0) {
            $sql = "INSERT INTO categories (name,super_id) values ('$name',$category_id)";
            mysqli_query($con, $sql);
            $msg = 'add Succeed!';
            $name = '';
        }
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
                    <h1><?= $pageTitle ?>!</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php"><?= $pageTitle ?></a></li>
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
                <div class="col-12">
                    <!-- Default box -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?= $type ?> your data!</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($errorForm) and count($errorForm) > 0) {
                                    foreach ($errorForm as $error) {
                                ?>
                                        <div class="alert alert-danger"><?= $error ?></div>
                                <?php }
                                } ?>
                                <?php if (isset($msg)) {
                                ?>
                                    <div class="alert alert-success"><?= $msg ?></div>
                                <?php
                                }
                                ?>
                                <label for="">item Name</label>
                                <input type="text" name="name" class="form-control name" value="<?php if (isset($name)) {
                                                                                                    echo $name;
                                                                                                } ?>" placeholder="Enter item Name here" id=""><br>
                                <label for="">Super category</label>
                                <select class="form-control Category" name="Category" id="">
                                    <option value="non">As super category</option>
                                    <?php
                                    $sqlCat1 = "SELECT * from categories where super_id is null";
                                    $resultCat1 = mysqli_query($con, $sqlCat1);
                                    if (mysqli_num_rows($resultCat1)) {
                                        while ($rowsCat = mysqli_fetch_assoc($resultCat1)) {
                                    ?>
                                            <option value="<?= $rowsCat['id'] ?>"><?= $rowsCat['name'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" value="<?= $type ?>">
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->
                    </form>
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