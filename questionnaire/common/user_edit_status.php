<!-- charset=UTF-8 -->
<!-- 
  @功能：修改用户组并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在修改，请稍后...';
$id = $_REQUEST ["id"];
if ($id == null) {
	echo '<script>window.location="../admin/group_edit.php?category=用户组管理&status=用户组不允许为空";</script>';
	die ();
}
$name = $_REQUEST ["name"];
if ($name == null) {
	echo '<script>window.location="../admin/group_edit.php?status=用户组不允许为空";</script>';
	die ();
}
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 检查用户组是否存在
$sql = "select name from groups where name=? and id!=?";
db_bind_param ( $sql, 1, $name, 'STRING' );
db_bind_param ( $sql, 1, $id, 'STRING' );
$array = db_select ( $sql, $con );
if (count ( $array ) > 0) {
	echo '<script>window.location="../admin/group_edit.php?category=用户组管理&status=该用户组已经存在";</script>';
	die ();
}

// 添加题型
$sql = "update groups set name=? where id=?";
db_bind_param ( $sql, 1, $name, 'STRING' );
db_bind_param ( $sql, 1, $id, 'STRING' );
db_insert ( $sql, $con );
echo '<script>window.location="../admin/group.php?category=权限管理";</script>';
db_close ( $con );
?>