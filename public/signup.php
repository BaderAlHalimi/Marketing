<?php
include '../db.php';
session_start();
// include 'include/header.php';
require_once '../GoogleAPI/vendor/autoload.php';
require_once '../phpMailer/mail.php';




// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $id =  $google_account_info->id;
    $email =  $google_account_info->email;
    $first_name =  $google_account_info->givenName;
    $last_name =  $google_account_info->familyName;
    $gender =  $google_account_info->gender;
    $full_name =  $google_account_info->name;
    $picture =  $google_account_info->picture;
    $verifiedEmail =  $google_account_info->verifiedEmail;

    $checker = "SELECT * from google_accounts where token = $id";
    var_dump($checker);
    $Check_result = mysqli_query($con, $checker);
    if (mysqli_num_rows($Check_result)) {
        $rows = mysqli_fetch_assoc($Check_result);
        $_SESSION['name'] = $rows['name'];
        $_SESSION['email'] = $rows['email'];
        $_SESSION['google_account'] = $rows['id'];
        $_SESSION['login'] = true;
        $_SERVER['REQUEST_METHOD'] = null;
        header('Location:index.php');
        exit;
    } else {
        $insert_account = "INSERT INTO google_accounts (token,email,first_name,last_name,gender,full_name,picture,verifiedEmail) VALUES('$id','$email','$first_name','$last_name','$gender','$full_name','$picture',$verifiedEmail)";
        mysqli_query($con, $insert_account);



        $mail->setFrom('badermarket7@gmail.com', 'Market Bader');
        $mail->addAddress((string)$email);               //Name is optional
        $mail->Subject = 'Hi ' . $full_name . ', Activate your Account!';
        $mail->Body    = '<b>Welcome to our community<br/>see you soon';
        $mail->send();


        $checker = "SELECT * from google_accounts where token = $id";
        $Check_result = mysqli_query($con, $checker);
        if (mysqli_num_rows($Check_result)) {
            $rows = mysqli_fetch_assoc($Check_result);
            $_SESSION['name'] = $rows['name'];
            $_SESSION['email'] = $rows['email'];
            $_SESSION['google_account'] = $rows['id'];
            $_SESSION['login'] = true;
            $_SERVER['REQUEST_METHOD'] = null;
            header('Location:index.php');
            exit;
        }
    }
    // now you can use this profile info to create account in your website and make user logged in.
}



$pageTitle = 'Sign up';
if (isset($_SESSION['login'])) {
    header('Location:index.php');
    exit;
}
$pass_password = 1;
$msg_l;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errorForm = array();
    if (isset($_POST['g-recaptcha-response'])) {
        $secritkey = '6LcHWr8jAAAAADDddJFAu1IWl4kcIibAvQjqVZPl';
        $r_ip = $_SERVER['REMOTE_ADDR'];
        $responsive = $_POST['g-recaptcha-response'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secritkey&response=$responsive&remoteip=$r_ip";
        $fire = file_get_contents($url);
        $data = json_decode($fire);
        if ($data->success != true) {
            $errorForm[] = 'recaptcha is required!';
        }
    }
    $name = $_POST['name'];
    if (empty($name)) {
        $errorForm[] = 'name is required!';
    }
    $email = $_POST['email'];
    $sql_check = "select email from users where email = '$email'";
    $result = mysqli_query($con, $sql_check);
    if (mysqli_num_rows($result)) {
        while ($rows = mysqli_fetch_assoc($result)) {
            if ($rows['email'] == $email) {
                $errorForm[] = 'Try another email!';
            }
        }
    }
    if (empty($email)) {
        $errorForm[] = 'email is required!';
    }
    $mobile = $_POST['mobile'];
    if (empty($mobile)) {
        $errorForm[] = 'mobile is required!';
    }
    $password = $_POST['password'];
    if (empty($password)) {
        $errorForm[] = 'password is required!';
    }
    $password2 = $_POST['password2'];
    if ($password != $password2) {
        $pass_password = 0;
    } else {
        if (count($errorForm) == 0) {
            $hash_pass = sha1($password);
            $activate = rand(100000, 999999);
            $sql = "INSERT INTO users(name,email,mobile,password,activate) values ('$name','$email','$mobile','$hash_pass',$activate)";
            $result = mysqli_query($con, $sql);
            $mail->setFrom('badermarket7@gmail.com', 'Market Bader');
            $mail->addAddress((string)$email);               //Name is optional
            $mail->Subject = 'Hi ' . $full_name . ', Activate your Account!';
            $mail->Body    = '<div style="padding: 2% 4%; background: linear-gradient(to right,orange,rgb(255, 242, 0));text-align: left;">
            <h1 style="color: white; font-size: 300%;text-shadow: 0px 2px 5px black;">Bader Market</h1>
            </div>
            <div><b>Welcome to our community</b>, you can use the following code to identify your account: <br/></div>' . $activate . '<br/>see you soon';
            $mail->send();
            $msg_l = 'Sign up Successfuly!!';
            $_SESSION['is_active'] = 0;
            $_SESSION['is_active_email'] = $email;
            header('location:activate.php');
            exit;
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
    <!-- <title>Login</title> -->
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
    <center>
        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-4 offset-sm-2 offset-lg-4">
                        <!-- Default box -->
                        <div>
                            <?php
                            echo "<a class='form-control' href='" . $client->createAuthUrl() . "'><div style='display: inline-block; width: 8%'><img style='width: 100%;' src='../GoogleAPI/png-clipart-youtube-google-logo-google-s-google-account-youtube-text-trademark.png'></div><strong style='margin-left: 10px;'><h3 style = 'position: relative; top: 7px; display: inline-block; margin: 0; padding: 0;'>Continue with Google</h3></strong> </a>";
                            ?>
                        </div><br>
                        <div class="card">
                            <div class="card-header">
                                <form action="" method="post">
                                    <h3>Sign Up</h3><br>
                                    <?php
                                    if (isset($msg_l)) { ?>
                                        <p class="alert alert-success"><?= $msg_l ?></p>
                                    <?php }
                                    ?>
                                    <?php
                                    if (isset($errorForm) and count($errorForm) > 0) {
                                        foreach ($errorForm as $err) { ?>
                                            <p class="alert alert-danger"><?= $err ?></p>
                                    <?php }
                                    }
                                    ?>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your name"><br>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email"><br>
                                    <input type="tel" name="mobile" class="form-control" placeholder="Enter your mobile"><br>
                                    <input type="password" name="password" class="form-control" placeholder="Enter password"><br>
                                    <input type="password" name="password2" class="form-control <?php if ($pass_password == 0) {
                                                                                                    echo 'alert alert-danger';
                                                                                                } ?>" placeholder="Enter password again"><br>
                                    <div class="g-recaptcha" data-sitekey="6LcHWr8jAAAAAJJlP7a_gBMbux5O1pqPs6BRz7NM"></div><br>
                                    <input type="submit" value="signup" class="btn btn-primary">
                                    <br>
                                    <div><a>or <a href="Login.php">Login</a></a></div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </center>
</body>

</html>