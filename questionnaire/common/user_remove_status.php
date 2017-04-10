<!-- charset=UTF-8 -->
<!-- 
  @功能：删除用户并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在删除，请稍后...';
$id = $_REQUEST ["id"];
if ($id == null) {
	echo '<script>window.location="../admin/user_remove.php?category=用户管理&status=用户编号不允许为空";</script>';
	die ();
}
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 删除用户
usr_remove_user ( $id, $con );
echo '<script>window.location="../admin/user.php?category=用户管理";</script>';
db_close ( $con );
?>