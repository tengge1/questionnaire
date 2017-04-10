<!-- charset=UTF-8 -->
<!-- 
  @功能：删除题库并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在删除，请稍后...';
$id = $_REQUEST ["id"];
if ($id == null) {
	echo '<script>window.location="../question/questionnaire_remove.php?category=题库管理&status=题目编号不允许为空&questionnaire_id=' . $_REQUEST ["questionnaire_id"] . '";</script>';
	die ();
}
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 删除题目
$sql = "delete from question where id=?";
db_bind_param ( $sql, 1, $id, 'STRING' );
db_delete ( $sql, $con );
echo '<script>window.location="../question/question.php?category=题库管理&questionnaire_id=' . $_REQUEST ["questionnaire_id"] . '";</script>';
db_close ( $con );
?>