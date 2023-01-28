<?php
include '../db.php';
if (isset($_SESSION['login'])) {
    if (isset($_SESSION['google_account'])) {
        $google_id = $_SESSION['google_account'];
        $sql1 = "SELECT count(invoice_id) as num from invoice where gaccount_id = $google_id and done =0 and is_delete = 0";
        $result1 = mysqli_query($con, $sql1);
        if (mysqli_num_rows($result1)) {
            $row1 = mysqli_fetch_assoc($result1);
            $cart_num = $row1['num'];
        }else{
            $cart_num = 0;
        }
    } else if(isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        $sql1 = "SELECT count(invoice_id) as num from invoice where user_id = $user_id and done =0 and is_delete = 0";
        $result1 = mysqli_query($con, $sql1);
        if (mysqli_num_rows($result1)) {
            $row1 = mysqli_fetch_assoc($result1);
            $cart_num = $row1['num'];
        }else{
            $cart_num = 0;
        }
    }
} else {
    $cart_num = '!';
}
