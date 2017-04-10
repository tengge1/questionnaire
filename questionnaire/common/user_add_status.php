<!-- charset=UTF-8 -->
<!-- 
  @功能：添加用户并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在添加，请稍后...';
$username = $_REQUEST ["username"];
$password = $_REQUEST ["password"];
$name = $_REQUEST ["name"];
if ($username == null) {
	echo '<script>window.location="../admin/user_add.php?status=用户名不允许为空";</script>';
	die ();
}
if ($password == null) {
	echo '<script>window.location="../admin/user_add.php?status=密码不允许为空";</script>';
	die ();
}
if ($name == null) {
	echo '<script>window.location="../admin/user_add.php?status=姓名不允许为空";</script>';
	die ();
}
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 检查用户名是否存在
$sql = "select username from user where username=?";
db_bind_param ( $sql, 1, $username, 'STRING' );
$array = db_select ( $sql, $con );
if (count ( $array ) > 0) {
	echo '<script>window.location="../admin/user_add.php?category=用户管理&status=该用户名已经存在";</script>';
	die ();
}

// 添加用户组
usr_add_user ( $username, $password, $name, '0', $con );
echo '<script>window.location="../admin/user.php?category=用户管理";</script>';
db_close ( $con );
?>