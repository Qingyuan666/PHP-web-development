<?php require 'header.php';
$key = '';
if(!empty($_POST['key'])){
	$key = $_POST['key'];
}
?>
 <div class="content">
    <div class="cont w1000">
	<img class="banner-img" src="style/img/liuyan.jpg"> 
      <div class="title">
    
 <form  action="" method="post">
Search
<input type="text" name="key" value="<?php echo $key;?>" placeholder="key words">
			
<input type="submit" name="submit" value="Search">
</form>
      </div>
<div style="width:1000px;margin:0 auto;">

 
      <div class="list-item">
	  <?php

	$users_id = $_SESSION['loginuser']['id'];
	

	$where = '';
	if(!empty($key)){
		$where = " and ( tags like '%".$key."%'
		or title like '%".$key."%'
		or content like '%".$key."%')
		
		";
	}
	$sql="select * from blogs where is_view = 1 ".$where." order by c_date desc";
	
	
	$result=$db->query($sql); 

    $total=$db->num_rows($result);
    $page=new page_link($total,4);
    $sql.=" limit $page->firstcount,$page->displaypg";

    $result=$db->query($sql);
    while($row=mysqli_fetch_array($result)){
			  $f_date=$row['c_date'];
?>
        <div class="item">
                <div class="img"><img src="./upload/<?php echo $row['images'];?>"  style="width:120px;" alt=""></div>
            
                  <h3><a href="details.php?id=<?php echo $row['id'];?>"><?php echo htmlspecialchars($row['title']);?>
				  </a></h3>
                  <h5>tag：<a href="list.php?tags=<?php echo $row['tags'];?>">
				  <?php echo $row['tags'];?></a> | 
				  click：<?php echo $row['hits'];?>  | 
				  like：<?php echo $row['zan'];?>  | 
				  collect：<?php echo $row['fav'];?> 
				  </h5>  
                  <p><?php echo str_cut($row['content'],'220');?></p>
                  <a href="details.php?id=<?php echo $row['id'];?>" class="go-icon"></a>
          <hr>    
        </div>
		 <?php
		  }
		  
		  ?>
      
      </div>
      <div  style="text-align: center;"><?php echo $page->show_link();?></div>
   
  </div>
<?php require 'foot.php';?>