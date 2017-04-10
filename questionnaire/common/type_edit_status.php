<!-- charset=UTF-8 -->
<!-- 
  @功能：修改题型并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在修改，请稍后...';
$id = $_REQUEST ["id"];
if ($id == null) {
	echo '<script>window.location="../question/type_edit.php?category=题型管理&status=题型不允许为空";</script>';
	die ();
}
$name = $_REQUEST ["name"];
if ($name == null) {
	echo '<script>window.location="../question/type_edit.php?status=题型不允许为空";</script>';
	die ();
}
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 检查题型是否存在
$sql = "select name from type where name=? and id!=?";
db_bind_param ( $sql, 1, $name, 'STRING' );
db_bind_param ( $sql, 1, $id, 'STRING' );
$array = db_select ( $sql, $con );
if (count ( $array ) > 0) {
	echo '<script>window.location="../question/type_edit.php?category=题型管理&status=该题型已经存在";</script>';
	die ();
}

// 添加题型
$sql = "update type set name=? where id=?";
db_bind_param ( $sql, 1, $name, 'STRING' );
db_bind_param ( $sql, 1, $id, 'STRING' );
db_insert ( $sql, $con );
echo '<script>window.location="../question/type.php?category=题型管理";</script>';
db_close ( $con );
?>