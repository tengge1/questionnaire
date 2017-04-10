<!-- charset=UTF-8 -->
<!-- 
  @功能：添加用户组并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在添加，请稍后...';
$name = $_REQUEST ["name"];
if ($name == null) {
	echo '<script>window.location="../admin/group_add.php?status=用户组不允许为空";</script>';
	die ();
}
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 检查用户组是否存在
$sql = "select name from groups where name=?";
db_bind_param ( $sql, 1, $name, 'STRING' );
$array = db_select ( $sql, $con );
if (count ( $array ) > 0) {
	echo '<script>window.location="../admin/group_add.php?category=用户组管理&status=该用户组已经存在";</script>';
	die ();
}

// 添加用户组
grp_add_group($name, $con);
echo '<script>window.location="../admin/group.php?category=用户组管理";</script>';
db_close ( $con );
?>