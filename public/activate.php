<?php
session_start();
$msg;
include '../db.php';




if (isset($_SESSION['is_active'])) {
    $email = $_SESSION['is_active_email'];
    $sql = "SELECT * from users where email = '$email'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $code = $_POST['code'];
            $activate = $row['activate'];
            if ($code == $activate) {
                $sql_update = "UPDATE users set is_active = 1 where email = '$email'";
                mysqli_query($con, $sql_update);
                $_SESSION['name'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['admin'] = $row['is_admin'];
                $_SESSION['login'] = true;
                $_SERVER['REQUEST_METHOD'] = null;
                header('Location:index.php');
                exit;
            }
        }
?>

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Activate Your Account!</title>
            <!-- Google Font: Source Sans Pro -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <!-- Font Awesome -->
            <!-- CSS only -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
            <!-- JavaScript Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
            <!-- Theme style -->
            <link rel="icon" type="image/x-icon" href="../uploads/166902696943644.jpg">
        </head>

        <body>
            <br><br><br><br>
            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <center>
                            <div class="col-3">
                                <!-- Default box -->
                                <div class="card">
                                    <div class="card-header text-center">
                                        <form action="" method="post">
                                            <br><br>
                                            <h3>Activate Your Account!</h3>
                                            <p>Enter the code that send to <a style="color: blue;"><?= $row['email'] ?></a> </p><br>
                                            <?php
                                            if (isset($msg)) { ?>
                                                <p class="alert alert-danger"><?= $msg ?></p>
                                            <?php }
                                            ?>
                                            <input type="text" name="code" class="form-control" placeholder="Code..."><br>
                                            <input type="submit" value="Active" class="btn btn-primary">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                </div>
            </section>
        </body>

        </html>
<?php
    } else {
        header('Location:index.php');
        exit;
    }
}
?>