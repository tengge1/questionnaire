<!-- charset=UTF-8 -->
<!-- 
  @功能：添加问卷并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在添加，请稍后...';
$name = $_REQUEST ["name"];
if ($name == null) {
	echo '<script>window.location="../question/request_add.php?status=问卷不允许为空";</script>';
	die ();
}
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 添加问卷
$sql = "insert into request (name) values (?)";
db_bind_param ( $sql, 1, $name, 'STRING' );
db_insert ( $sql, $con );
echo '<script>window.location="../question/request.php?category=问卷管理";</script>';
db_close ( $con );
?>