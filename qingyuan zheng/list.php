<?php require 'header.php';?>

  <div class="banner">
    <div class="cont w1000">
      <div class="title">
        <h3>MY<br />BLOG</h3>
        <h4>well-balanced heart</h4>
      </div>
     <div class="amount">
        <p><span class="text">MYBLOG</span></p>
        <p><span class="text">there are</span><span class="daily-record">10000+ book friends </span></p>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="cont w1000">
      <div class="title">
        <span class="layui-breadcrumb" lay-separator="|">
		<a href="index.php" >Tags:all</a>
		<?php foreach($tags as $k=>$v){?>
			 <a href="list.php?tags=<?php echo $v;?>" <?php if($_GET['tags']==$v){echo 'class="active"';}?>><?php echo $v;?></a>
		<?php }?>
        </span>
      </div>
      <div class="list-item">
	  <?php

	$users_id = $_SESSION['loginuser']['id'];
	$xy_sql="select * from blogs where tags='".$_GET['tags']."' and  is_view=1  order by id desc,c_date desc";
	$result=$db->query($xy_sql); 

   $total=$db->num_rows($result);
   $page=new page_link($total,30);
   $xy_sql.=" limit $page->firstcount,$page->displaypg";
// echo $xy_sql;
   $result=$db->query($xy_sql);
    while($row=mysqli_fetch_array($result)){
			  $f_date=$row['c_date'];
?>
        <div class="item">
          <div class="layui-fluid">
            <div class="layui-row">
              <div class="layui-col-xs12 layui-col-sm4 layui-col-md5">
                <div class="img"><img src="./upload/<?php echo $row['images'];?>"  alt=""></div>
              </div>
              <div class="layui-col-xs12 layui-col-sm8 layui-col-md7">
                <div class="item-cont">
                  <h3><a href="details.php?id=<?php echo $row['id'];?>"><?php echo htmlspecialchars($row['title']);?><button class="layui-btn layui-btn-danger new-icon"><?php echo $row['hits'];?></button></a></h3>
                  <h5>✉ <a href="list.php?tags=<?php echo $v;?>">
				  <?php echo $row['tags'];?>
				  </a></h5>
                  <p><?php echo str_cut($row['content'],'120');?></p>
                  <a href="details.php?id=<?php echo $row['id'];?>" class="go-icon"></a>
                </div>
            </div>
            </div>
           </div>
        </div>
		 <?php
		  }
		  
		  ?>
      
      </div>
      <div  style="text-align: center;"><?php echo $page->show_link();?></div>
    </div>
  </div>
<?php require 'foot.php';?>