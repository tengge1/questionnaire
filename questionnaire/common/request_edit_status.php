<!-- charset=UTF-8 -->
<!-- 
  @功能：修改问卷并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在修改，请稍后...';
$id = $_REQUEST ["id"];
if ($id == null) {
	echo '<script>window.location="../question/request_edit.php?category=问卷管理&status=问卷编号不允许为空";</script>';
	die ();
}
$name = $_REQUEST ["name"];
if ($name == null) {
	echo '<script>window.location="../question/questionnaire_edit.php?status=问卷名称不允许为空";</script>';
	die ();
}
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 修改问卷
$sql = "update request set name=? where id=?";
db_bind_param ( $sql, 1, $name, 'STRING' );
db_bind_param ( $sql, 1, $id, 'STRING' );
db_insert ( $sql, $con );
echo '<script>window.location="../question/request.php?category=问卷管理";</script>';
db_close ( $con );
?>