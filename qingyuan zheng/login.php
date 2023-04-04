<?php require 'header.php';?>
<?php

if(!empty($_POST)){
		
		if(empty($_POST['account_name'])){
			ok_info('./login.php','name');exit();
		}
		if(empty($_POST['password'])){
			ok_info('./login.php','pass word');exit();
		}
		$sql="select * from c_user where account_name='{$_POST['account_name']}' 
		and password='{$_POST['password']}'
		order by id desc";
		$u_r = $db->get_all($sql);


		if(empty($u_r)){
			ok_info(0,"username or password wrong");
		}else{
			$_SESSION['login'] = 1;
			$_SESSION['loginuser'] = $u_r[0];
			$_SESSION["m_name"] = $u_r[0]['nickname'];
			$_SESSION["c_users"] = $u_r[0];
			ok_info('./index.php','login successfully！');
		}
}
?>

<style>
.layui-input-block label{ float:left;display:inline;width:100px;text-align:right;}
.layui-input-block input[type=text],
.layui-input-block input[type=password]{ 
width:200px;text-align:left;
border:1px solid #999;
border-radius:3px;
padding:3px;
margin:3px;
height:20px;
}
.layui-input-block input[type=submit]{ float:left;display:inline;width:200px;text-align:center;color:#fff;
background:#000;padding:3px;
border:1px solid #999;
border-radius:3px;
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
					  <form action="" method="post" class="form-inline" id="comment-form">
					  <div class="layui-form-item layui-form-text">
						<div class="layui-input-block">
						  <label for="messageName">User name：</label>
						  <input type="text" name="account_name" class="form-control" id="account_name" placeholder=""><font color="#FF0000"><i id="b_n_t"></i> *</font>
						</div>
						<div class="layui-input-block">
						   <label for="messageName">Password：</label>
						  <input type="password" name="password" class="form-control" id="password" ><font color="red"><i id="password_t"></i>*</font>
						</div>
					  </div>
					  <div class="layui-input-block">
					   <label style="color:#fff" > ·</label>
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