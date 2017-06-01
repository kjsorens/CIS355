<?php
/* ---------------------------------------------------------------------------
 * filename    : logout.php
 * author      : Kyle Sorenson
 * description : This file will log the user out of the rating application
 * ---------------------------------------------------------------------------
 */
session_start();
session_destroy();
unset($_SESSION['username']);
$_SESSION['message']="You are now logged out";
header("location:login.php");
?>