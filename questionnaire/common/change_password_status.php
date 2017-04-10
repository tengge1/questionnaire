<?php session_start(); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：修改密码并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在修改密码，请稍后...';
$old_password = $_REQUEST ["old_password"];
$new_password = $_REQUEST ["new_password"];
$confirm_password = $_REQUEST ["confirm_password"];
$username = $_SESSION["username"];
if ($username == null) {
	echo '<script>window.location="../admin/change_password.php?status=请先登录";</script>';
	die ();
}
if ($old_password == null) {
	echo '<script>window.location="../admin/change_password.php?status=原密码不允许为空";</script>';
	die ();
}
if ($new_password == null) {
	echo '<script>window.location="../admin/change_password.php?status=新密码不允许为空";</script>';
	die ();
}
if ($confirm_password == null) {
	echo '<script>window.location="../admin/change_password.php?status=确认密码不允许为空";</script>';
	die ();
}
if ($new_password != $confirm_password) {
	echo '<script>window.location="../admin/change_password.php?status=新密码和确认密码不相同";</script>';
	die ();
}
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );
// 先检查原密码是否正确
$sql = "select * from user where username=? and password=?";
db_bind_param ( $sql, 1, $username, 'STRING' );
db_bind_param ( $sql, 1, $old_password, 'STRING' );
$array = db_select ( $sql, $con );
if (count ( $array ) == 0) {
	echo '<script>window.location="../admin/change_password.php?status=原密码错误";</script>';
	die ();
}
// 修改密码
$sql = "update user set password=? where username=?";
db_bind_param ( $sql, 1, $new_password, 'STRING' );
db_bind_param ( $sql, 1, $username, 'STRING' );
db_update ( $sql, $con );
// echo '<script src="../res/js/navigate.js" />';
echo '<script>window.location="../admin/change_password.php?status=密码修改成功&success=true";</script>';
db_close ( $con );
?>