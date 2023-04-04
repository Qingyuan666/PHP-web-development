<?php
require 'header.php';
?>
<?php
$d_id = isset ($_GET['id']) ? intval($_GET['id']) : '0' ;
$sql ="delete from blogs where id=".$d_id."";
$res = $db->query($sql);
$db->query("delete from blogs_reply where b_id=".$d_id."");
if ($res){
  ok_info('blog_my.php',"delete！");
}else{
  ok_info('blog_my.php',"fail delete！");
  
}
$db->close();
?> 