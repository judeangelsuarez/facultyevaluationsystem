<?php
session_start();
unset($_SESSION['fname']);
unset($_SESSION['facidno']);
unset($_SESSION['depid']);
header("Location: ../login.php");
?>