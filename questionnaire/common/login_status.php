<?php session_start(); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：登录并获取登录状态
  @日期：2015-03-29
-->

<?php
echo '正在登录，请稍后...';
include_once '../config/config.php';
include_once '../function/fun.php';
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );
$sql = "select id,username,name from user where username=? and password=?";
$username = $_REQUEST ["username"];
$password = $_REQUEST ["password"];
db_bind_param ( $sql, 1, $username, 'STRING' );
db_bind_param ( $sql, 1, $password, 'STRING' );
$array = db_select ( $sql, $con );
if (count ( $array ) > 0) { // 登录成功
	$userinfo = $array [0];
	$_SESSION ["username"] = $userinfo ["username"];
	$_SESSION ["name"] = $userinfo ["name"];
	session_write_close ();
	echo '<script src="../res/js/navigate.js"></script>';
	echo '<script type="text/javascript">navigate("../question/index.php?category=填写问卷",1000);</script>';
} else { // 登录失败
	echo '<script>window.location="../admin/login.php?status=用户名或密码错误";</script>';
}
db_close ( $con );
?>