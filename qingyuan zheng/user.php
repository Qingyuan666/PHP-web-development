<?php require 'header.php';?>

<?php
$id = $_SESSION['loginuser']['id'];
$one=$db->get_one("select * from c_user where id=$id",MYSQLI_ASSOC);
if(!empty($_POST)){
	$id = $_SESSION['loginuser']['id'];
	if(empty($_POST['account_name'])){
		ok_info('./user.php','username');exit();
	}
	if(empty($_POST['password'])){
		ok_info('./user.php','password');exit();
	}
	
	
	if($_FILES["file"]["size"]>0){
		
		$allowedExts = array("doc", "docx", "xls", "xlsx", "ppt", "zip", "rar", "jpg", "gif", "png", "bmp");
		$temp = explode(".", $_FILES["file"]["name"]);

		$extension = end($temp);     
		if (($_FILES["file"]["size"] < 2048000)   
		&& in_array($extension, $allowedExts))
		{
			if ($_FILES["file"]["error"] > 0)
			{
				echo "<script>alert('wrong： " . $_FILES["file"]["error"] . "\\n');</script>";;exit();
			}
			else
			{
				
				$tmp_name =  date('YmdHis').mt_rand().'_'.$_FILES["file"]["name"];
				
				
				
				
				$fpath="./upload/" .$tmp_name;
				if (file_exists("./upload/" . $tmp_name))
				{
					echo "<script>alert('".$tmp_name . " file has existed ');</script>";;exit();
				}
				else
				{
					
					move_uploaded_file($_FILES["file"]["tmp_name"], "./upload/" . $tmp_name);
					
				}
			}
		}
		else
		{
			echo "<script>alert('wrong file form');location='user.php'</script>";exit();
		}
	
	}
	
	$siteinfo = array(
			'nickname' => injCheck($_POST['nickname']),
			'password' => injCheck($_POST['password']),
			'qizhi' => injCheck($_POST['qizhi']),
			'tmp_name' => $tmp_name,
			'sex' => injCheck($_POST['sex']),
			'email' => injCheck($_POST['email']),
			'birthday' => injCheck($_POST['birthday']),
			'c_date' => time()
			);
	$db->update("c_user", $siteinfo,"id=$id");
	$db->close();
	$_SESSION['login'] = 1;
	$_SESSION['loginuser'] = $siteinfo;
	ok_info('./login.php','edit successfully');
}
?>
<style>
.layui-input-block label{ float:left;display:inline;width:200px;text-align:right;}
.layui-input-block input[type=text],
.layui-input-block input[type=password]{ 
width:300px;text-align:left;
border:1px solid #999;
border-radius:6px;
padding:6px;
margin:6px;
height:30px;
}
.layui-input-block input[type=submit]{ float:left;display:inline;width:300px;text-align:center;color:#fff;
background:#000;padding:6px;
border:1px solid #999;
border-radius:6px;

}
</style>
  <div class="content">
    <div class="cont w1000">
	 <img class="banner-img" src="style/img/banner.jpg"> 
      <div class="title">
        <span class="layui-breadcrumb" lay-separator="|">
          <a href="user.php" class="active">My Account</a>
          <a href="blog_my.php">My Book Comments</a>
          <a href="blog_add.php">Publish Comments</a>
          <a href="blog_zan.php">My like</a>
          <a href="blog_like.php">My Collection</a>
          
        </span>
      </div>
      <div class="list-item">
        <div class="form">
					  <form action="" method="post" class="form-inline" id="comment-form" enctype="multipart/form-data">
					  <div class="layui-form-item layui-form-text">
						<div class="layui-input-block">
						  <label style="">username：</label>
						  <input type="text" name="account_name" class="form-control" id="account_name" placeholder="login" value="<?php echo $one['account_name'];?>">
						  <font color="#FF0000"><i id="b_n_t"></i> *</font>
						</div>
						<div class="layui-input-block">
						   <label>password：</label>
						  <input type="password" name="password" class="form-control" id="password"  value="<?php echo $one['password'];?>">
						  <font color="red"><i id="password_t"></i>*</font>
						</div>
						
						
						<div class="layui-input-block">
						  <label >choose a beautiful reader name：</label>
						  <input type="text" name="nickname" class="form-control" id="nickname" placeholder="reader name: such as Shakespeare"  value="<?php echo $one['nickname'];?>">
						  <font color="#FF0000"><i id="b_n_t"></i> *</font>
						</div>
						
						<div class="layui-input-block">
						  <label >choose one animal to 
						  symbol your reader style ：
						  </label>
					<?php foreach($qizhi as $k=>$v){?>
			 <input type="radio" class="input-text" name="qizhi" value="<?php echo $v;?>" <?php if($v==$one['qizhi']){?> checked <?php }?>/><?php echo $v;?>
		<?php }?>
						</div>
						<div class="layui-input-block">
						  <label >gender：</label>
						  <input type="radio" name="sex" class="form-control"  value="0" checked>male
						  <input type="radio" name="sex" class="form-control"  value="1">female
						  <input type="radio" name="sex" class="form-control"  value="1">unknown
						  </font>
						</div>
						
						
						<div class="layui-input-block">
						  <label >email：</label>
						  <input type="text" name="email" class="form-control" id="email" value="<?php echo $one['email'];?>" placeholder="email：186@qq.com"><font color="#FF0000"><i id="b_n_mail"></i> *</font>
						</div>
					  </div>
					  <div class="layui-input-block"><label style="color:#fff" > ·</label>
							<input type="submit" value="submit"/>
					  </div>
					</form>
					</div>
    </div>
  </div>
<?php require 'foot.php';?>