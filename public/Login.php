<?php
session_start();
require_once '../GoogleAPI/vendor/autoload.php';
if (isset($_SESSION['login'])) {
    header('Location:index.php');
    exit;
}
include '../db.php';
$msg_login = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['g-recaptcha-response'])) {
        $secritkey = '6LcHWr8jAAAAADDddJFAu1IWl4kcIibAvQjqVZPl';
        $r_ip = $_SERVER['REMOTE_ADDR'];
        $responsive = $_POST['g-recaptcha-response'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secritkey&response=$responsive&remoteip=$r_ip";
        $fire = file_get_contents($url);
        $data = json_decode($fire);
        if ($data->success != true) {
            $msg_login[] = 'recaptcha is required!';
        }
    }
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash_pass = sha1($password);
    if (isset($msg_login) and count($msg_login) == 0) {
        $sql = "SELECT * from users where email = '$email' and password = '$hash_pass'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result)) {
            $rows = mysqli_fetch_assoc($result);
            $is_active = $rows['is_active'];
            if ($is_active == 1) {
                $_SESSION['name'] = $rows['name'];
                $_SESSION['email'] = $rows['email'];
                $_SESSION['id'] = $rows['id'];
                $_SESSION['admin'] = $rows['is_admin'];
                $_SESSION['login'] = true;
                $_SERVER['REQUEST_METHOD'] = null;
                header('Location:index.php');
                exit;
            } else {
                $_SESSION['is_active'] = 0;
                $_SESSION['is_active_email'] = $rows['email'];
                header('location:activate.php');
                exit;
            }
        } else {
            $msg_login[] = "Wrong!!, Check email and password!!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Theme style -->
    <link rel="icon" type="image/x-icon" href="../uploads/166902696943644.jpg">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LcHWr8jAAAAAJJlP7a_gBMbux5O1pqPs6BRz7NM"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcHWr8jAAAAAJJlP7a_gBMbux5O1pqPs6BRz7NM', {
                action: 'Signup'
            }).then(function(token) {
                console.log(token)
            });
        });
    </script>
</head>

<body>
    <br><br><br><br>
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-4 offset-sm-2 offset-lg-4">
                    <!-- Default box -->
                    <div style="text-align: center;">
                        <?php
                        echo "<a class='form-control' href='" . $client->createAuthUrl() . "'><div style='display: inline-block; width: 8%'><img style='width: 100%;' src='../GoogleAPI/png-clipart-youtube-google-logo-google-s-google-account-youtube-text-trademark.png'></div><strong style='margin-left: 10px;'><h3 style = 'position: relative; top: 7px; display: inline-block; margin: 0; padding: 0;'>Continue with Google</h3></strong> </a>";
                        ?>
                    </div><br>
                    <div class="card">
                        <div class="card-header text-center">
                            <form action="" method="post">
                                <br><br>
                                <h3>Login</h3><br>
                                <?php
                                if (isset($msg_login) and count($msg_login) > 0) {
                                    foreach ($msg_login as $err) { ?>
                                        <p class="alert alert-danger"><?= $err ?></p>
                                <?php }
                                }
                                ?>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email"><br>
                                <input type="password" name="password" class="form-control" placeholder="Enter your password"><br>
                                <center>
                                    <div class="g-recaptcha" data-sitekey="6LcHWr8jAAAAAJJlP7a_gBMbux5O1pqPs6BRz7NM"></div>
                                </center>
                                <br>
                                <input type="submit" value="Login" class="btn btn-primary">
                                <br><a>or <a href="signup.php">Sign up</a></a><br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>