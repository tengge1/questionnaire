<!-- charset=UTF-8 -->
<!-- 
  @功能：添加题目并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在添加，请稍后...';
$questionnaire_id = $_REQUEST ["questionnaire_id"];
$type = $_REQUEST ["type"];
$content = $_REQUEST ["content"];
if ($questionnaire_id == null) {
	echo '<script>window.location="../question/question_add.php?status=题库不允许为空&questionnaire_id=' . $questionnaire_id . '";</script>';
	die ();
}
if ($type == null) {
	echo '<script>window.location="../question/question_add.php?status=题型不允许为空&questionnaire_id=' . $questionnaire_id . '";</script>';
	die ();
}
if ($content == null) {
	echo '<script>window.location="../question/question_add.php?status=题干不允许为空&questionnaire_id=' . $questionnaire_id . '";</script>';
	die ();
}
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 查询该题型对应的编号
$sql = "select id from type where name=?";
db_bind_param ( $sql, 1, $type, 'STRING' );
$array = db_select ( $sql, $con );
if (count ( $array ) == 0) {
	echo '<script>window.location="../question/question_add.php?status=该题型不存在&questionnaire_id=' . $questionnaire_id . '";</script>';
	die ();
}
$type_id = $array [0] ["id"];
// 添加问题
$sql = "insert into question (questionnaire_id,type_id,content) values (?,?,?)";
db_bind_param ( $sql, 1, $questionnaire_id, 'INT' );
db_bind_param ( $sql, 1, $type_id, 'STRING' );
db_bind_param ( $sql, 1, $content, 'STRING' );
db_insert ( $sql, $con );
// 查询最新插入题目的id
$sql = "select id from question where questionnaire_id=? order by id desc";
db_bind_param ( $sql, 1, $questionnaire_id, 'INT' );
$array = db_select ( $sql, $con );
$question_id = $array [0]["id"];
// 添加所有选项
foreach ( array_keys ( $_REQUEST ) as $key ) {
	$pos = strpos ( $key, 'option' );
	if ($pos === 0) { // 键中以option开头
		$opt = substr ( $key, 7 );
		$val = $_REQUEST [$key];
		$sql = " insert into options (question_id,option_id,content) values (?,?,?)";
		db_bind_param ( $sql, 1, $question_id, 'INT' );
		db_bind_param ( $sql, 1, $opt, 'STRING' );
		db_bind_param ( $sql, 1, $val, 'STRING' );
		db_insert ( $sql, $con );
	}
}
echo '<script>window.location="../question/question.php?category=题库管理&questionnaire_id=' . $questionnaire_id . '";</script>';
db_close ( $con );
?>