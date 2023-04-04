<?php
/**action successful tips**/
function ok_info($url,$langinfo){
	if(empty($url)){
		echo("<script type='text/javascript'> alert('$langinfo');history.go(-1);</script>");		
	}else{
		echo("<script type='text/javascript'> alert('$langinfo'); window.location.href='$url'; 
		</script>");  
	}
	exit;
}

function getIp() {
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
		$ip = getenv("HTTP_CLIENT_IP");
	else
		if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else
			if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
				$ip = getenv("REMOTE_ADDR");
			else
				if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
					$ip = $_SERVER['REMOTE_ADDR'];
				else
					$ip = "unknown";
	return ($ip);
}

function xy_rep($str){ 
return str_replace(array('#', '@', '\'','or'),'', $str);
}

function str_cut($string, $length, $dot = '...',$charset='utf-8') {
	$strlen = strlen($string);
	if($strlen <= $length) return $string;
	$string = str_replace(array(' ','&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array('∵',' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
	$strcut = '';
	if(strtolower($charset) == 'utf-8') {
		$length = intval($length-strlen($dot)-$length/3);
		$n = $tn = $noc = 0;
		while($n < strlen($string)) {
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t <= 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) {
				break;
			}
		}
		if($noc > $length) {
			$n -= $tn;
		}
		$strcut = substr($string, 0, $n);
		$strcut = str_replace(array('∵', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), array(' ', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), $strcut);
	} else {
		$dotlen = strlen($dot);
		$maxi = $length - $dotlen - 1;
		$current_str = '';
		$search_arr = array('&',' ', '"', "'", '“', '”', '—', '<', '>', '·', '…','∵');
		$replace_arr = array('&amp;','&nbsp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;',' ');
		$search_flip = array_flip($search_arr);
		for ($i = 0; $i < $maxi; $i++) {
			$current_str = ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
			if (in_array($current_str, $search_arr)) {
				$key = $search_flip[$current_str];
				$current_str = str_replace($search_arr[$key], $replace_arr[$key], $current_str);
			}
			$strcut .= $current_str;
		}
	}
	return $strcut.$dot;
}

function injCheck($sql_str) { 
	$check = preg_match('/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/', $sql_str);
	if ($check) {
		ok_info('/index.php','wrong character form');
		exit;
	} else {
		return $sql_str;
	}
}


function getUsername($uid){
	global $db;
	$sql="select nickname from c_user where id=$uid";
	
	$result =$db->query($sql);
	$row =$db->get_one($sql);
		return $row['nickname'];
	
}
function getUserInfo($uid){
	global $db;
	$sql="select * from c_user where id=$uid";
	$result =$db->query($sql);
	$row =$db->get_one($sql);
		return $row;
}
function setHits($id){
	global $db;

	$sql = "UPDATE blogs SET hits=hits+1 WHERE id='{$id}'";
	
	$db->query($sql);
	$sql="select * from blogs where id='{$id}'";
	$v = $db->get_one($sql,MYSQLI_ASSOC);
	
}

function getnums($catid){
	global $db;
	$sql="select id from blogs_reply where b_id=$catid";
	$result =$db->query($sql);
	if($result){
		echo "[<font color='#FF0000'>".$db->num_rows($result)."</font>]";
	}else{
		echo "[<font color='#FF0000'>0</font>]";
	}
}

function getUsers($uid){
	global $db;
	$sql="select id from c_user where id!='".$uid."'";
	$result =$db->get_all($sql);
	return $result;
}
function getshouchang($uid){
	global $db;
	$sql="select b_id from blogs_vote_log where users_id='".$uid."'";
	$data =$db->get_all($sql);
	foreach($data as $k=>$v){
		$result[]=$v['b_id'];
	}
	return $result;
}


function recommend($uid){
	global $db;
	$recommend = array();
	$b_id_arr = array();
	//my like
	$my_shoucang = getshouchang($uid);
	//other user
	$users = getUsers($uid);
	
	foreach($users as $k=>$v){
		//other user like
		$user_shoucang = getshouchang($v['id']);
		//compare the liked content
		if(empty($my_shoucang)||empty($user_shoucang)){
			$d  = 0;
		}else{
			$d = array_diff_assoc($user_shoucang,$my_shoucang);
		
		}
		//the same liked content
		if(empty($d)){
			$flag = 1; //like number is the same
			$total = 0;
		}else{
			$flag = 0;//like number is not same
			//the number is not the same
			$num1 = array_product($d);//multiple
			$num2 = array_sum($d);//sum
			$total = $num1+$num2;
		}
		//recommendation
		if($total>0){
				
			foreach($d as $kk=>$vv){
				if(!in_array($vv,$b_id_arr)){
					$b_id_arr[]=$vv;
				}
			}
			
		}
		
	}

	$b_id_str = implode(',',$b_id_arr);

	$sql="select * from blogs where id in (".$b_id_str.")";
	
	$recommend =$db->get_all($sql);
		
	return $recommend; 
}
?>