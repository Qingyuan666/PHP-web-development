<?php
header("Content-type: text/html;charset=utf-8");
error_reporting(1);
@set_time_limit(0);
define('BLOG_BOOK',true);
define('BLOGPATH', substr(dirname(__FILE__), 0, -4));
PHP_VERSION >= '5.1' && date_default_timezone_set('America/New York');
//session_cache_limiter('private, must-revalidate'); 
//@ini_set('session.auto_start',0);
if(PHP_VERSION < '4.1.0') {
	$_GET         = &$HTTP_GET_VARS;
	$_POST        = &$HTTP_POST_VARS;
	$_COOKIE      = &$HTTP_COOKIE_VARS;
	$_SERVER      = &$HTTP_SERVER_VARS;
	$_ENV         = &$HTTP_ENV_VARS;
	$_FILES       = &$HTTP_POST_FILES;
}
require BLOGPATH.'Conf/conn.php';
require BLOGPATH.'Libs/Function/globle.php';
require BLOGPATH.'Libs/Function/fun.php';
require BLOGPATH.'Libs/Class/mysql.class.php';
require BLOGPATH.'Libs/Class/page.class.php';
$db = new mysql($db_host,$db_user,$db_pass,$dnickname,0);



if(!isset($_SESSION['login'])||$_SESSION['login']!=1){
	$_SESSION['login']==0;
	$_SESSION['loginuser']==array('nickname','guest');
}
?>