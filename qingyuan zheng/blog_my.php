<?php require 'header.php';

$users_id = $_SESSION['loginuser']['id'];
$xy_sql="select * from blogs where users_id=".$users_id." order by id desc,c_date desc";
$result=$db->query($xy_sql); 

   $total=$db->num_rows($result);
   $page=new page_link($total,30);
   $xy_sql.=" limit $page->firstcount,$page->displaypg";

   $result=$db->query($xy_sql);
?>

<script language="javascript">
function ask(msg) {
	if( msg=='' ) {
		msg='the deleted content cannot be recovered？';
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
      <div class="list-item">
      <div class="table-list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="40">ID</th>
            <th>image</th>
            <th>tag</th>
            <th>title</th>
            <th width="70">like</th>
            <th width="70">read</th>
            <th width="70">status</th>
            <th width="200">management</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while($row=mysqli_fetch_array($result)){
			  $f_date=$row['c_date'];
		  ?>
          <tr>
           
            <td align="center"><?php echo $row['id'];?></td>
			<td align="center">
			<?php if(!empty($row['images'])){?>
				<img src="./upload/<?php echo $row['images'];?>"  width="50">
			<?php }?>
			</td>
            <td><?php echo $row['tags'];?></td>
            <td>
			<a href="details.php?id=<?php echo $row['id'];?>">
			<?php echo htmlspecialchars($row['title']);?></a>&nbsp;&nbsp;</td>
		
            <td align="center"><?php echo $row['zan'];?></td>
            <td align="center"><?php echo $row['hits'];?></td>	
            <td align="center">
			<?php if($row['is_view']==1){?>
			<font color="green">public</font>
			<?php }else if($row['is_view']==2){?>
			<font color="pink">only friends</font>
			<?php }else{?>
			<font color="red">private</font><?php }?>
			</td>
            <td align="center"><a href="blog_reply.php?bid=<?php echo $row['id'];?>">show the reply</a><font color="#FF0000"><?php getnums($row['id']);?></font>
			/<a href="blog_edit.php?id=<?php echo $row['id'];?>">edit</a>/<a href="javascript:if(ask('the deleted content cannot be recovered')) location.href='blog_del.php?id=<?php echo $row['id'];?>';" onClick="delcfm();">删除</a></td>
          </tr>
          <?php
		  }
		  
		  ?>
        </tbody>
      </table>
	  
<div id="pages" class="page">
<?php echo $page->show_link();?>
</div>
    </div>
      </div>
   
    </div>
  </div>
<?php require 'foot.php';?>