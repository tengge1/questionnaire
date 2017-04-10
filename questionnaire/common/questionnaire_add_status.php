<!-- charset=UTF-8 -->
<!-- 
  @功能：添加题库并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在添加，请稍后...';
$name = $_REQUEST ["name"];
if ($name == null) {
	echo '<script>window.location="../question/questionnaire_add.php?status=题库不允许为空";</script>';
	die ();
}
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 检查题型是否存在
$sql = "select name from questionnaire where name=?";
db_bind_param ( $sql, 1, $name, 'STRING' );
$array = db_select ( $sql, $con );
if (count ( $array ) > 0) {
	echo '<script>window.location="../question/questionnaire_add.php?category=题库管理&status=该题库已经存在";</script>';
	die ();
}

// 添加题型
$sql = "insert into questionnaire (name) values (?)";
db_bind_param ( $sql, 1, $name, 'STRING' );
db_insert ( $sql, $con );
echo '<script>window.location="../question/questionnaire.php?category=题库管理";</script>';
db_close ( $con );
?>