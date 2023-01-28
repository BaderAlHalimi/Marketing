<?php

include '../db.php';
$name;
$type;
$details;
$edit_id = "non";
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $pageTitle = 'Edit Item';
} else {
    $pageTitle = 'Add Item';
}
include 'include/header.php';
include 'include/sidebar.php';
if ($edit_id != "non") {
    $type = 'Update';
    $sql = "SELECT * from items where id = $edit_id and is_delete = 0";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result)) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $name = $rows['name'];
            $details = $rows['details'];
            $price = $rows['price'];
            $discount = $rows['discount'];
            $quantity = $rows['quantity'];
            $category_id = $rows['category_id'];
        }
    }
    $image;
    $user_id = $_SESSION['id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = addslashes($_POST['name']);
        $details = addslashes($_POST['details']);
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $quantity = $_POST['quantity'];
        $category_id = $_POST['Category'];

        $errorForm = array();
        if (empty($name)) {
            $errorForm[] = 'name is requierd';
        }
        if (empty($quantity)) {
            $errorForm[] = 'quantity is requierd';
        }
        if (empty($details)) {
            $errorForm[] = 'details is requierd';
        }
        if (empty($category_id)) {
            $errorForm[] = 'category is requierd';
        }
        if (empty($price)) {
            $errorForm[] = 'price is requierd';
        } else if (!is_numeric($price)) {
            $errorForm[] = 'price is number value!!!!';
        }
        $image = $_FILES['image'];
        if ($image['name'] != '') {
            $image_name = $image['name'];
            $image_tmp_name = $image['tmp_name'];
            $image_type = $image['type'];
            $image_size = $image['size'];

            $extension_array = explode('.', $image_name);
            $extension = strtolower(end($extension_array));


            $image_to_save = time() . rand(10000, 99999) . '.' . $extension;
            $target = '../uploades/' . $image_to_save;
            if (count($errorForm) == 0) {
                $done = false;
                $date = date('Y-m-d h:i:s');
                if ($discount > 0) {
                    $sql1 = "UPDATE items set name = '$name',quantity = $quantity , details = '$details',discount = $discount, user_id = $user_id,updated_at = '$date', price = $price,image = '$image_to_save',category_id = $category_id where id = $edit_id";
                } else if ($discount == "0" or empty($discount)) {
                    $sql1 = "UPDATE items set name = '$name',quantity = $quantity , details = '$details',discount = null, user_id = $user_id,updated_at = '$date', price = $price,image = '$image_to_save',category_id = $category_id where id = $edit_id";
                } else {
                    $sql1 = "UPDATE items set name = '$name',quantity = $quantity, details = '$details', user_id = $user_id,updated_at = '$date', price = $price,image = '$image_to_save',category_id = $category_id where id = $edit_id";
                }
                try {
                    mysqli_query($con, $sql1);
                    $done = true;
                    move_uploaded_file($image_tmp_name, $target);
                    $msg = 'Update Succeed!';
                } catch (Exception) {
                    $done = false;
                }
                if ($done != true) {
                    $errorForm[] = 'Your Details is repeted';
                }
            }
        } else {
            if (count($errorForm) == 0) {
                $done = false;
                $date = date('Y-m-d h:i:s');
                if ($discount > 0) {
                    $sql1 = "UPDATE items set name = '$name',quantity = $quantity, details = '$details',discount = $discount, user_id = $user_id, updated_at = '$date', price = $price,category_id = $category_id where id = $edit_id";
                } else if ($discount == "0" or empty($discount)) {
                    $sql1 = "UPDATE items set name = '$name',quantity = $quantity , details = '$details',discount = null, user_id = $user_id,updated_at = '$date', price = $price,category_id = $category_id where id = $edit_id";
                } else {
                    $sql1 = "UPDATE items set name = '$name',quantity = $quantity, details = '$details', user_id = $user_id, updated_at = '$date', price = $price,category_id = $category_id where id = $edit_id";
                }
                try {
                    mysqli_query($con, $sql1);
                    $done = true;
                } catch (Exception) {
                    $done = false;
                }
                if ($done == true) {
                    $msg = 'Update Succeed!';
                } else {
                    $errorForm[] = 'Your Details is repeted';
                }
            }
        }
    }
} else {
    $type = 'Add';
    $image;
    $user_id = $_SESSION['id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = addslashes($_POST['name']);
        $details = addslashes($_POST['details']);
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category_id = $_POST['Category'];
        $errorForm = array();
        if (empty($name)) {
            $errorForm[] = 'name is requierd';
        }
        if (empty($quantity)) {
            $errorForm[] = 'quantity is requierd';
        }
        if (empty($details)) {
            $errorForm[] = 'details is requierd';
        }
        if (empty($category_id)) {
            $errorForm[] = 'category is requierd';
        }
        if (empty($price)) {
            $errorForm[] = 'price is requierd';
        } else if (!is_numeric($price)) {
            $errorForm[] = 'price is number value!!!!';
        }
        $image = $_FILES['image'];
        if ($image['name'] != '') {
            $image_name = $image['name'];
            $image_tmp_name = $image['tmp_name'];
            $image_type = $image['type'];
            $image_size = $image['size'];

            $extension_array = explode('.', $image_name);
            $extension = strtolower(end($extension_array));

            $image_to_save = time() . rand(10000, 99999) . '.' . $extension;
            $target = '../uploades/' . $image_to_save;
        } else {
            $errorForm[] = 'image is requierd';
        }

        if (count($errorForm) == 0) {
            $done = false;
            $date = date('Y-m-d h:i:s');
            $sql = "INSERT INTO items (name,details,image,user_id,create_at, price,quantity,category_id) values ('$name','$details','$image_to_save',$user_id,'$date',$price,$quantity,$category_id)";
            try {
                mysqli_query($con, $sql);
                $done = true;
            } catch (Exception) {
                $done = false;
            }
            if ($done == true) {
                move_uploaded_file($image_tmp_name, $target);
                $msg = 'add Succeed!';
                $name = '';
                $details = '';
            } else {
                $errorForm[] = 'Your Details is repeted';
            }
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
                                <label for="">image</label>
                                <input type="file" class="form-control image" name="image"><br>

                                <label for="">item Name</label>
                                <input type="text" name="name" class="form-control name" value="<?php if (isset($name)) {
                                                                                                    echo $name;
                                                                                                } ?>" placeholder="Enter item Name here" id=""><br>
                                <label for="">details</label>
                                <textarea name="details" class="form-control name" placeholder="Details" cols="30" rows="10"><?php if (isset($details)) {
                                                                                                                                    echo $details;
                                                                                                                                } ?></textarea>
                                <label for="">Price</label>
                                <input type="text" name="price" class="form-control price" value="<?php if (isset($price)) {
                                                                                                        echo $price;
                                                                                                    } ?>" placeholder="Enter item price here" id=""><br>
                                <label for="">Discount</label>
                                <input type="text" name="discount" class="form-control discount" value="<?php if (isset($discount)) {
                                                                                                                echo $discount;
                                                                                                            } ?>" placeholder="Enter item discount here" id=""><br>
                                <label for="">Quantity</label>
                                <input type="number" name="quantity" class="form-control Quantity" value="<?php if (isset($quantity)) {
                                                                                                                echo $quantity;
                                                                                                            } ?>" placeholder="Enter item quantity here" id=""><br>

                                <label for="">Category</label>
                                <select class="form-control Category" name="Category" id="">
                                    <option value="">--</option>
                                    <?php
                                    $sqlCat1 = "SELECT * from categories where super_id is null";
                                    $resultCat1 = mysqli_query($con, $sqlCat1);
                                    if (mysqli_num_rows($resultCat1)) {
                                        while ($rowsCat = mysqli_fetch_assoc($resultCat1)) {
                                    ?>
                                            <optgroup label="<?= $rowsCat['name'] ?>">
                                                <?php
                                                $super_id = $rowsCat['id'];
                                                $sqlCat2 = "SELECT * from categories where super_id = $super_id";
                                                $resultCat2 = mysqli_query($con, $sqlCat2);
                                                if (mysqli_num_rows($resultCat2)) {
                                                    while ($rowsCat2 = mysqli_fetch_assoc($resultCat2)) {
                                                ?>
                                                        <option value="<?= $rowsCat2['id'] ?>" <?php if (isset($category_id) && $category_id == $rowsCat2['id']) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?= $rowsCat2['name'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </optgroup>
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