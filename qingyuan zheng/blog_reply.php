<?php require 'header.php';
$x_id=intval(trim($_GET['bid']));
$x_m=$_GET['act'];
$x_keys=$_POST['keyword'];
if(!empty($x_id)){
	$txt = 'reply';
}else{
	$txt = 'comment';
}
?>

<script language="javascript">
function ask(msg) {
	if( msg=='' ) {
		msg='the deleted things cannot be recovered';
	}
	if (confirm(msg)) {
		return true;
	} else {
		return false;
	}
}
</script>
  <div class="content">
    <div class="cont w1000">
	<img class="banner-img" src="style/img/liuyan.jpg"> 
      <div class="title">
          <span class="layui-breadcrumb" lay-separator="|">
          <a href="user.php">My Account</a>
          <a href="blog_my.php" class="active">My Book Comments</a>
          <a href="blog_add.php">Publish Comments</a>
          <a href="blog_zan.php">My like</a>
          <a href="blog_like.php">My Collection</a>
          
        </span>
      </div>
     <?php
   $w = '';
if($_SESSION['login_kind']==2){
	$w = " and r_u_id='".$_SESSION['c_users']['id']."'";
}
   if($x_id=='' || $x_id==0){
	   $sql="select id from blogs_reply where b_id=0 ".$w."";
   }else{
	   $sql="select id from blogs_reply where b_id='".$x_id."' ".$w;
   }
   
   $ids=$db->get_all($sql,MYSQLI_ASSOC);
   if($ids){
	   foreach($ids as $k){
		   $xyids.=$k['id'].',';  
	   }
   }
   $xyids=substr($xyids,0,strlen($xyids)-1);
   $total=count($ids);
   $page=new page_link($total,30);
   if($x_m=='search' and $x_keys!=""){
	$xy_sql="select * from blogs_reply where id in($xyids) and title like '%$x_keys%' order by id desc limit $page->firstcount,$page->displaypg";
   }else{
	$xy_sql="select * from blogs_reply where id in($xyids) order by id desc limit $page->firstcount,$page->displaypg";
   }
   $result=$db->get_all($xy_sql,MYSQLI_ASSOC);
   ?>
    <div class="table-list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="40">ID</th>
            <th width="200">date</th>
            <th width="200">commentator</th>
            <th>comment content</th>
			
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($result as $row){
			 
		  ?>
          <tr>
            <td align="center"><?php echo $row['id'];?></td>
            <td align="center"><?php echo $row['c_date'];?></td>
            <td align="center"><?php 
			$getUserInfo = getUserInfo($row['users_id']);
			echo $getUserInfo['nickname'];?></td>
            <td><?php echo $row['content'];?> </a> &nbsp;&nbsp;</td>
			
           
          </tr>
          <?php
		  }
		  
		  ?>
        </tbody>
      </table>
    </div>
<div id="pages" class="page">
<?php echo $page->show_link();?>
</div>
    </div>
      </div>
   
    </div>
  </div>
<?php require 'foot.php';?>