<?php 
session_start();
$_SESSION['login'] = 0;
$_SESSION['loginuser'] = '';
unset($_SESSION['loginuser']);
header("Location: ./index.php");
 ?>