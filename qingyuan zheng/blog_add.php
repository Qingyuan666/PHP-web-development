<?php require 'header.php';

if($_GET["act"]==ok){
	
	$c_date = date('Y-m-d H:i:s');
	if(isset($_FILES["file"]["name"])&&!empty($_FILES["file"]["name"])){
		// the file form allowed
		$allowedExts = array("jpg","jpeg", "gif", "png", "bmp");
		$temp = explode(".", $_FILES["file"]["name"]);

		$extension = end($temp);     // get the suffix of file name
		if (($_FILES["file"]["size"] < 2048000)   
		&& in_array($extension, $allowedExts))
		{
			if ($_FILES["file"]["error"] > 0)
			{
				echo "<script>alert('wrong： " . $_FILES["file"]["error"] . "\\n');</script>";
			}
			else
			{
				$tmp_name =  date('YmdHis').mt_rand(10,100).'_'.$_FILES["file"]["name"];
				$fpath="upload/" .$tmp_name;
				if (file_exists("upload/" . $tmp_name))
				{
					echo "<script>alert('".$tmp_name . " file has existed ');</script>";
				}
				else
				{
					move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $tmp_name);
				}
			}
		}
		else
		{
			echo "<script>alert('wrong file form');location='blog_add.php'</script>";
		}
	}else{
		$tmp_name='';
	}
		
		$users_id = $_SESSION['loginuser']['id'];		
		$siteinfo = array(
		'title' => $_POST['title'],
		'tags' => $_POST['tags'],
	
		'users_id' => $users_id,
		'content' => $_POST['content'],
		'images' => $tmp_name,
		'is_view' => $_POST['is_view'],
		'c_date' => $c_date
		);
		$db->insert("blogs", $siteinfo);
	
		echo "<script language='javascript'>"; 
		echo "alert('content publication sccussfully');";
		echo " location='blog_my.php';"; 
		echo "</script>";
}
?>

  <div class="content">
    <div class="cont w1000">
	<img class="banner-img" src="style/img/liuyan.jpg"> 
      <div class="title">
        <span class="layui-breadcrumb" lay-separator="|">
          <a href="user.php">My Account</a>
          <a href="blog_my.php">My Book Comment</a>
          <a href="blog_add.php" class="active">Publish Book Comment</a>
          <a href="blog_zan.php">My Like</a>
          <a href="blog_like.php">My Collection</a>
          
        </span>
      </div>
      <div class="list-item">
        <div class="item">
         
  <form name="addform" id="addform" action="?act=ok" method="post" enctype="multipart/form-data">
    <table cellpadding=0 cellspacing=0 class="table_form" width="100%">
      <tr>
        <td width="10%" ><font color="red">*</font>title</td>
        <td width="90%" >
          <input type="text" class="input-text" name="title"  id="title"  size="55" />
          &nbsp;
          </td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>tag</td>
        <td width="90%" ><input type="text" class="input-text" name="tags"  id="tags"  size="55" />
		
        </td>
      </tr>
	  
      <tr>
        <td width="10%" >content</td>
        <td width="90%" id="box_pics"><textarea name="content" id="content" cols="85" rows="18"></textarea></td>
      </tr>
      <tr>
        <td width="10%" >whether show</td>
        <td width="90%" id="box_posid"><select id="is_view" name="is_view" class="input_select" >
            <option value="0">private</option>
            <option value="1" selected="selected">public</option>
          </select></td>
      </tr>
      <tr>
        <td width="10%" ></td>
        <td width="90%" id="box_posid"> 
		<INPUT TYPE="submit"  value="submit" class="button" onClick='javascript:return checkaddform()'>
      <input TYPE="reset"  value="reset" class="button"></td>
      </tr>
      
    </table>
  </form>
        </div>
        
        
      
      </div>
    </div>
  </div>
<?php require 'foot.php';?>