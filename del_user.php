<?php
session_start();
require "class.php";
require "functions.php";
$err = "";
$id = $_GET['uid'];
if ($_SESSION['se_level'] != 1) {
	header('location: login.php');
	exit();
}
$muser = new User;
$muser->delUser($id);
header('location: index.php');
exit();