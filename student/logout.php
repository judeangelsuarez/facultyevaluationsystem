<?php
session_start();
unset($_SESSION['sname']);
unset($_SESSION['studid']);
unset($_SESSION['coursename']);
header("Location: ../login.php");
?>