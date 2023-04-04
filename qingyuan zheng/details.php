<?php require 'header.php';
$id = $_GET['id'];
//read count
setHits($id);

if($_GET["act"]=='ok'){
	$id = $_POST['id'];
	$siteinfo = array(
	    'b_id'=>$id,
		'content ' => $_POST['content'],
		'users_id' => $users_id,
		'c_date' => $c_date
		);
	$db->insert("blogs_reply", $siteinfo);
	//$db->close();
    echo "<script language='javascript'>"; 
    echo "alert('new comment successfully');";
    echo " location='details.php?id=".$id."';"; 
    echo "</script>";
}

$row=$db->get_one("select * from blogs where id=$id",MYSQLI_ASSOC);
$is_view=$row['is_view'];
$users_id = $_SESSION['loginuser']['id'];
$c_date = date('Y-m-d H:i:s');

?>
  <div class="content whisper-content leacots-content details-content">
    <div class="cont w1000">
      <div class="whisper-list">
        <div class="item-box">
          <div class="review-version">
		  <table  class="cont w1000">
		  <tr>
		  <td width="680" style="padding-right:10px;border-right:1px solid #000;">
              <div class="form-box">
                <div class="article-cont">
                  <div class="title">
                    <h3><?php echo htmlspecialchars($row['title']);?></h3>
                    <p class="cont-info">
					<span class="data">☼<?php echo $row['c_date'];?></span>
					<span class="types">ღ<?php echo $row['tags'];?></span>
					<span class="types">📍 <?php echo $row['address'];?></span>
					<span class="types">@
					<?php $nickname = getUsername($row['users_id']); echo $nickname;?></span>
					</p>
                  </div>
                <p style="text-align:center;">
				<img src="./upload/<?php echo $row['images'];?>" style="width:600px;"></p>
                  
                  <p><?php echo $row['content'];?></p>
                     <div class="impl_old_buy_btn">
						<style type="text/css">
						   .zandiv{padding-left:2px;width:100%;height:140px;border-top:1px solid #000}
						   .zanul{float:left;list-style:none;width:100%;height:40px;
						   text-align:center;}
						   .zanli{float:left;
						   text-align:center;width:30%;height:40px;
						   }
						   .img26{width:18px;height:18px;text-align:center;margin-left:5px;cursor: pointer;}
						   .p{text-align:center;}
						</style>
						<div class="zandiv"><p >welcome click like</p>
							<ul class="zanul">
								
								<li  class="zanli zan">
									<img  class="img26 " _v=""  src="style/img/yizan.png" style="margin-left:30px;width:28px;height:28px;" />
									（<b class="likes" id="zan<?php echo $row['id'];?>"><?php echo $row['zan'];?></b>）like
								</li>
								<li  class="zanli fav">
									<img  class="img26 " _v=""  src="style/img/yizan2.png" style="margin-left:30px;width:28px;height:28px;" />
									（<b class="likes" id="fav<?php echo $row['id'];?>"><?php echo $row['fav'];?></b>）collect
								</li>
							</ul>
						</div>
                    </div>
                 
                </div>
               
              </div>
			</td>
		  <td width="280"  valign = "top" style="padding-left:10px;">
		 
		  <h1 style="font-size:24px;">Contents you may also be interested in</h1>
		  <?php 
		  $users_id = $_SESSION['loginuser']['id'];
		  $list = recommend($users_id);
		
		 foreach($list as $k=>$v){ 
			 ?>
			  <p><a href="details.php?id=<?php echo $v['id'];?>"><?php echo htmlspecialchars($v['title']);?>
				  </a></p>
			 <?php 
		 }
		 if(empty($list)){
			 echo "<p>no</p>";
		 }
		  ?>
		
		  </td>
		  </tr>
		  </table>
             
          </div>
        </div>
      </div>
      <div id="demo" style="text-align: center;"></div>
    </div>
  </div>
 
<script type="text/javascript" src="style/js/jquery.js"></script>
<script type="text/javascript">
            $(function () {
				
                $(".zan").click(function () {
                  $.ajax({
						url:"./vote.php", //request server address
						data:{
						   id:<?php echo $row['id'];?>
						  , type:'zan'
						 },
						type:"post",
						dataType:"html",
						success:function(data){
							if(data){
								var a = $('#zan<?php echo $row['id'];?>').text(data);
							}else{
								alert('have like');
							}
							
						   
						}
					});
                    
                });
                $(".fav").click(function () {
					
                        $.ajax({
		
							url:"./vote.php", //request server
							data:{
							   id:<?php echo $row['id'];?>
							  , type:'fav'
							 },
							type:"post",
							dataType:"html",
							success:function(data){
								if(data){
								var a = $('#fav<?php echo $row['id'];?>').text(data);
								}else{
									alert('have collected');
								}
							   
							}
						});
                });
            });
        </script>
<?php require 'foot.php';?>