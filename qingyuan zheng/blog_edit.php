<?php
require 'header.php';
if($_GET["act"]==ok){
	$c_id=$_POST['id'];
	$c_date = date('Y-m-d H:i:s');
	//change image
	if(isset($_FILES["file"]["name"])&&!empty($_FILES["file"]["name"])){
		// file form
		$allowedExts = array("jpg","jpeg", "gif", "png", "bmp");
		$temp = explode(".", $_FILES["file"]["name"]);

		$extension = end($temp);     // suffix
		if (($_FILES["file"]["size"] < 2048000)   // less than 2
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
			echo "<script>alert('wrong file form');location='blog_edit.php'</script>";
		}
	}else{
		$tmp_name =  $_POST['images'];
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
	$db->update("blogs", $siteinfo,"id=$c_id");
	echo "<script language='javascript'>"; 
    echo "alert('information edit successfully!');";
    echo " location='blog_my.php';"; 
    echo "</script>";
}
$id=$_GET["id"];
$one=$db->get_one("select * from blogs where id=$id",MYSQLI_ASSOC);
$is_view=$one['is_view'];
?>

  <div class="content">
    <div class="cont w1000">
	<img class="banner-img" src="style/img/liuyan.jpg"> 
      <div class="title">
        <span class="layui-breadcrumb" lay-separator="|">
          <a href="user.php">My account</a>
          <a href="blog_my.php">My Book Comments</a>
          <a href="blog_add.php" class="active">Publish Comments</a>
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
          <input type="text" class="input-text" name="title"  value="<?php echo $one['title'];?>"  size="55" />
          <input type="hidden" class="input-text" name="id"  value="<?php echo $one['id'];?>"  size="55" />
          &nbsp;
          </td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>tag</td>
        <td width="90%" ><input type="text" class="input-text" name="tags"  id="tags"  value="<?php echo $one['tags'];?>" size="55" />
		
        </td>
      </tr>
	  <tr>
        <td width="10%" ><font color="red">*</font>image</td>
        <td width="90%" ><?php if(!empty($one['images'])){?>
				<img src="./upload/<?php echo $one['images'];?>"  width="50">
			<?php }?>
          <label for="file">upload file：</label>
	  <input type="file" name="file" id="file">
	  <input type="hidden" name="images"  value="<?php echo $one['images'];?>"  size="55" />
          <br>image file name need to be in English and number</td>
      </tr>
      <tr>
        <td width="10%" >content</td>
        <td width="90%" id="box_pics"><textarea name="content" id="content" cols="85" rows="18"><?php echo $one['content'];?></textarea></td>
      </tr>
      <tr>
        <td width="10%" >whether show</td>
        <td width="90%" id="box_posid"><select id="is_view" name="is_view" class="input_select" >
            <option value="0" <?php if($is_view==0){?> selected="selected"<?php }?>>private</option>
            <option value="1" <?php if($is_view==1){?> selected="selected"<?php }?>>public</option>
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