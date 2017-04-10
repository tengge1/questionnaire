<?php session_start(); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：注册并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在注册，请稍后...';
$username = $_REQUEST ["username"];
$password = $_REQUEST ["password"];
$confirm = $_REQUEST ["confirm"];
$name = $_REQUEST ["name"];
if ($username == null) {
	echo '<script>window.location="../admin/register.php?status=用户名不允许为空";</script>';
	die ();
}
if ($password == null) {
	echo '<script>window.location="../admin/register.php?status=密码不允许为空";</script>';
	die ();
}
if ($password != $confirm) {
	echo '<script>window.location="../admin/register.php?status=密码和确认密码不相同";</script>';
	die ();
}
if ($name == null) {
	echo '<script>window.location="../admin/register.php?status=昵称不允许为空";</script>';
	die ();
}
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 检查用户名是否存在
$sql = "select id,username,name from user where username=?";
db_bind_param ( $sql, 1, $username, 'STRING' );
$array = db_select ( $sql, $con );
if (count ( $array ) > 0) {
	echo '<script>window.location="../admin/register.php?status=该用户名已经存在";</script>';
	die ();
}
// 检查昵称是否存在
$sql = "select id,username,name from user where name=?";
db_bind_param ( $sql, 1, $name, 'STRING' );
$array = db_select ( $sql, $con );
if (count ( $array ) > 0) {
	echo '<script>window.location="../admin/register.php?status=该昵称已经存在";</script>';
	die ();
}
// 添加用户
$sql = "insert into user (username,password,name,admin) values (?,?,?,0)";
db_bind_param ( $sql, 1, $username, 'STRING' );
db_bind_param ( $sql, 1, $password, 'STRING' );
db_bind_param ( $sql, 1, $name, 'STRING' );
db_insert ( $sql, $con );
$_SESSION ['username'] = $username;
$_SESSION ['name'] = $name;
session_write_close ();
echo '<script>window.location="../question/index.php";</script>';
db_close ( $con );
?>