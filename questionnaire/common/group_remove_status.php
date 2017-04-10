<!-- charset=UTF-8 -->
<!-- 
  @功能：删除用户组并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在删除，请稍后...';
$id = $_REQUEST ["id"];
if ($id == null) {
	echo '<script>window.location="../admin/group_remove.php?category=用户组管理&status=用户组编号不允许为空";</script>';
	die ();
}
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 删除用户组
grp_remove_group ( $id, $con );
echo '<script>window.location="../admin/group.php?category=用户组管理";</script>';
db_close ( $con );
?>