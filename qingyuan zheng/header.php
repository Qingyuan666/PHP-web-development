<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <title>Book Comment</title>
  <link rel="stylesheet" type="text/css" href="style/css/main.css">
  <link rel="stylesheet" type="text/css" href="style/css/style.css">

<?php 
session_start();
require 'Conf/blog.inc.php';
?>
</head>
<body>
  
   <div  class="header" style="width:1000px;margin:0 auto;">
    <h1 class="logo">
      <a href="index.php">
        <span>Book Comment</span>
      </a>
    </h1>
	 <?php
		session_start();

		if(empty($_SESSION['loginuser']['nickname'])){
			$loginuser_name = 'friend';
		}else{
			$loginuser_name = $_SESSION['loginuser']['nickname']; 
		}?>
    <div class="nav">
      <a href="index.php" class="active">Homepage</a>
	 
	  <?php 
	  
		if(!empty($_SESSION['loginuser']['nickname'])){?>
			<a href="./user.php">[<?php echo $loginuser_name;?> ]My Account</a>
			<a href="logout.php">Logout</a>
		<?php }else{?>
		<a href="login.php">Login</a>
		<a href="register.php">Sign up</a>
		<?php }?>
    </div>

  </div>