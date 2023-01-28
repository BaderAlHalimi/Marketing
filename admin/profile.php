<?php
$pageTitle = 'Profile';
include 'include/header.php';
include 'include/sidebar.php';
include '../db.php';
$id = $_SESSION['id'];
$sql = "SELECT name,email,password from users where id = $id;";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result)) {
    while ($rows = mysqli_fetch_assoc($result)) {
        $name = $rows['name'];
        $email = $rows['email'];
        $oldPassword = $rows['password'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errorForm = array();
    $mag;
    if (empty($name)) {
        $errorForm[] = 'Name is required!';
    }
    if (empty($email)) {
        $errorForm[] = 'Email is required!';
    }
    if (empty($password)) {
        $password = $oldPassword;
    } else {
        $password = sha1($password);
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
            move_uploaded_file($image_tmp_name, $target);
            $sql_update = "UPDATE users SET name = '$name',image = '$image_to_save', email = '$email', password = '$password' where id = $id";
            mysqli_query($con, $sql_update);
            $msg = 'Update Succeed!';
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['email'] = $_POST['email'];
        }
    } else {
        if (count($errorForm) == 0) {
            $sql_update = "UPDATE users SET name = '$name', email = '$email', password = '$password' where id = $id";
            mysqli_query($con, $sql_update);
            $msg = 'Update Succeed!';
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['email'] = $_POST['email'];
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
                    <h1>Profile!</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
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
                    <div class="card">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">Update your data!</h3>

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
                                <label for="">Photo</label>
                                <input type="file" accept="image/*" class="form-control image" name="image"><br>
                                <label for="">name</label>
                                <input type="text" name="name" class="form-control name" value="<?= $name ?>" id=""><br>
                                <label for="">email</label>
                                <input type="email" name="email" class="form-control email" value="<?= $email ?>" id=""><br>
                                <label for="">password</label>
                                <input type="password" name="password" class="form-control password" id=""><br>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" value="update">
                            </div>
                        </form>
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