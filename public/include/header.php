<?php
if (!isset($_SESSION['login']) and $pageTitle != 'Sign up') {
    header('location:Login.php');
}
