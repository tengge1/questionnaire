<!-- charset=UTF-8 -->
<!-- 
  @功能：发布问卷并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在发布，请稍后...';
$id = $_REQUEST ["id"]; // 问卷编号
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 发布问卷
$sql = "select id from user";
$array = db_select ( $sql, $con );
foreach ( $array as $user_id ) {
	$sql = "insert into user_request (user_id,request_id) values (?,?)";
	db_bind_param ( $sql, 1, $user_id, 'INT' );
	db_bind_param ( $sql, 1, $id, 'INT' );
	db_insert ( $sql, $con );
}
echo '<script>window.location="../question/request.php?category=问卷管理&success=true&status=发布成功";</script>';
db_close ( $con );
?>