<?php 
session_start(); 
require 'Conf/blog.inc.php';
	$id   = $_POST['id'];
	$type = $_POST['type'];
	$users_id = $_SESSION['loginuser']['id'];
	$c_date = date('Y-m-d H:i:s');
	
	$sql = "select * from blogs_vote_log where b_id='".$id."' 
	and type = '".$type."'
	and users_id='".$users_id."'";
	$row=$db->get_one($sql);
	if(!empty($row)){
		echo false;
	}else{
	
		$sql = "UPDATE blogs SET ".$type."=".$type."+1 WHERE id='{$id}'";
		
		$siteinfo = array(
			'b_id'=>$id,
			'users_id' => $users_id,
			'type' => $type,
			'c_date' => $c_date
			);
		$db->insert("blogs_vote_log", $siteinfo);
		
		$db->query($sql);
		$sql="select * from blogs where id='{$id}' order by id desc";
		$v = $db->get_one($sql);
		
		echo $v[$type];
	}
?>
