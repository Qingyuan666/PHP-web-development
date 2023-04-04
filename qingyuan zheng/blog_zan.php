<?php require 'header.php';

$users_id = $_SESSION['loginuser']['id'];

$sql = "select * from blogs_vote_log where type = 'zan' and users_id='".$users_id."'";
$result = $db->get_all($sql);
$ids_arr = array();
foreach($result as $k=>$v){
	$ids_arr[] = $v['b_id'];
}
$id_str = implode("','",$ids_arr);

$xy_sql="select * from blogs where id in ('".$id_str."') order by id desc,c_date desc";
$result=$db->query($xy_sql); 

   $total=$db->num_rows($result);
   $page=new page_link($total,30);
   $xy_sql.=" limit $page->firstcount,$page->displaypg";

   $result=$db->query($xy_sql);
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
          <a href="blog_my.php">My Book Comments</a>
          <a href="blog_add.php">Publish Comments</a>
          <a href="blog_zan.php" class="active">My like</a>
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
			<?php echo htmlspecialchars($row['title']);?>&nbsp;&nbsp;
			</a></td>
		
            <td align="center"><?php echo $row['zan'];?></td>
            <td align="center"><?php echo $row['hits'];?></td>
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