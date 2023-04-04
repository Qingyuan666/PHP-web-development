<?php require 'header.php';?>
<?php

if(!empty($_POST)){
	if(empty($_POST['account_name'])){
		ok_info('./register.php','username');exit();
	}else{
		$sql="select * from c_user where account_name='{$_POST['account_name']}' order by id desc ";
		$siteinfo = $db->get_one($sql);
		if(!empty($siteinfo)){
			echo "<script language='javascript'>"; 
			echo "alert('account has existed');";echo " location='register.php';"; 
			echo "</script>";exit();
		}
	}
	if(empty($_POST['password'])){
		ok_info('./register.php','enter password');exit();
	}
	
	if(trim($_POST['password'])!=trim($_POST['re_pwd'])){
		
		echo "<script language='javascript'>"; 
		echo "alert('the password of two times need to be the same');";echo " location='register.php';"; 
		echo "</script>";exit();
	}
	$tmp_name = "";
	if($_FILES["file"]["size"]>0){//when there is image
		// the image file form allowed
		$allowedExts = array("doc", "docx", "xls", "xlsx", "ppt", "zip", "rar", "jpg", "gif", "png", "bmp");
		$temp = explode(".", $_FILES["file"]["name"]);

		$extension = end($temp);     // suffix
		if (($_FILES["file"]["size"] < 2048000)   // less than 2
		&& in_array($extension, $allowedExts))
		{
			if ($_FILES["file"]["error"] > 0)
			{
				echo "<script>alert('wrong： " . $_FILES["file"]["error"] . "\\n');</script>";;exit();
			}
			else
			{
				
				$tmp_name =  date('YmdHis').mt_rand().'_'.$_FILES["file"]["name"];
				
				
				
				// decide whether the file has existed 
				// if no content, creat content
				$fpath="./upload/" .$tmp_name;
				if (file_exists("./upload/" . $tmp_name))
				{
					echo "<script>alert('".$tmp_name . " the file has existed ');</script>";;exit();
				}
				else
				{
					// if the file has not existed 
					move_uploaded_file($_FILES["file"]["tmp_name"], "./upload/" . $tmp_name);
					
				}
			}
		}
		else
		{
			echo "<script>alert('wrong file form');location='register.php'</script>";exit();
		}
	
	}
	
	$siteinfo = array(
			'account_name' => injCheck($_POST['account_name']),
			'nickname' => injCheck($_POST['nickname']),
			'password' => injCheck($_POST['password']),
			'qizhi' => injCheck($_POST['qizhi']),
			'tmp_name' => $tmp_name,
			'sex' => injCheck($_POST['sex']),
			'email' => injCheck($_POST['email']),
			'birthday' => injCheck($_POST['birthday']),
			'c_date' => time()
			);
	$r = $db->insert("c_user", $siteinfo);
	if($r){
		ok_info('./login.php','Successfully! Please login');
	}else{
		ok_info('./register.php','Fail');
	}
	
	
	$db->close();
}
?>
<style>
.layui-input-block label{ float:left;display:inline;width:300px;text-align:right;}
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
  <div class="content whisper-content leacots-content">
    <div class="cont w1000">
      <div class="whisper-list">
        <div class="item-box">
          <div class="review-version">
              <div class="form-box">
                <img class="banner-img" src="style/img/banner.jpg">
					<div class="form">
					  <form action="" method="post" class="form-inline" id="comment-form" enctype="multipart/form-data">
					  <div class="layui-form-item layui-form-text">
						<div class="layui-input-block">
						  <label style="">username：</label>
						  <input type="text" name="account_name" class="form-control" id="account_name" placeholder="username login"><font color="#FF0000"><i id="b_n_t"></i> *</font>
						</div>
						<div class="layui-input-block">
						   <label>password：</label>
						  <input type="password" name="password" class="form-control" id="password" ><font color="red"><i id="password_t"></i>*</font>
						</div>
						<div class="layui-input-block">
						   <label >repeat password：</label>
						  <input type="password" name="re_pwd" class="form-control" id="re_pwd" ><font color="red"><i id="re_pwd_t"></i>*</font>
						</div>
						
			
						<div class="layui-input-block">
						  <label >choose a beautiful reader name：</label>
						  <input type="text" name="nickname" class="form-control" id="nickname" placeholder="reader name: such as Shakespeare"><font color="#FF0000"><i id="b_n_t"></i> *</font>
						</div>
						<div class="layui-input-block">
						  <label >choose one animal to 
						  symbol your reader style ：
						  </label>
						  	<?php foreach($qizhi as $k=>$v){?>
								 <input type="radio" class="input-text" name="qizhi" value="<?php echo $v;?>"/><?php echo $v;?>
							<?php }?>
						
						  </font>
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
						  <input type="email" name="email" class="form-control" id="email" placeholder="example：186@qq.com"><font color="#FF0000"><i id="b_n_mail"></i> *</font>
						</div>
					  </div>
					  <div class="layui-input-block"><label style="color:#fff" > ·</label>
							<input type="submit" value="submit"/>
					  </div>
					</form>
					</div>
              </div>
            
          </div>
        </div>
      </div>
      <div id="demo" style="text-align: center;"></div>
    </div>
  </div><?php require 'foot.php';?>