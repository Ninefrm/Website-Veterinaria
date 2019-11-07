<?php session_start();
session_destroy();
$_SESSION = array();
header('Location: Login.php');
die();
?>
