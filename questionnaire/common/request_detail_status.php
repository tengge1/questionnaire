<!-- charset=UTF-8 -->
<!-- 
  @功能：保存问卷题目并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在保存，请稍后...';
$id = $_REQUEST ["request_id"];
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 删除该问卷的所有问题
$sql = "delete from request_question where request_id=?";
db_bind_param ( $sql, 1, $id, 'INT' );
db_delete ( $sql, $con );

// 添加该问卷所有问题
foreach ( $_REQUEST ["questions"] as $question ) {
	$sql = "insert into request_question (request_id,question_id) values (?,?)";
	db_bind_param ( $sql, 1, $id, 'INT' );
	db_bind_param ( $sql, 1, $question, 'INT' );
	db_insert ( $sql, $con );
}

echo '<script>window.location="../question/request.php?category=问卷管理&request_id=' . $id . '";</script>';
db_close ( $con );
?>