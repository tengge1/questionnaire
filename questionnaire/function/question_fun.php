<!-- charset=UTF-8 -->
<!-- 
  @功能：问卷调查常用函数定义
  @日期：2015-03-29
-->

<?php
/*
 * 功能：获取所有题型
 * $con：数据库连接
 * 返回值：数组
 */
function qst_get_all_type($con) {
	$sql = "select id,name from type";
	return db_select ( $sql, $con );
}

/*
 * 功能：返回某个题型
 * $id：题型编号
 * $con：数据库连接
 * 返回值：数组
 */
function qst_get_type($id, $con) {
	$sql = "select id,name from type where id=?";
	db_bind_param ( $sql, 1, $id, 'INT' );
	return db_select ( $sql, $con );
}

/*
 * 功能：添加某种题型
 * $name：题型名称
 * $con：数据库连接
 * 返回值：无
 */
function qst_add_type($name, $con) {
	$sql = "insert into type (name) values (?)";
	db_bind_param ( $sql, 1, $name, 'STRING' );
	return db_insert ( $sql, $con );
}

/*
 * 功能：删除某种题型
 * $id：题型编号
 * $con：数据库连接
 * 返回值：无
 */
function qst_remove_type($id, $con) {
	$sql = "delete from type where id=?";
	db_bind_param ( $sql, 1, $id, 'STRING' );
	return db_delete ( $sql, $con );
}

/*
 * 功能：获取所有题库名称
 * $con：数据库连接
 * 返回值：数组
 */
function qst_get_all_questionnaire($con) {
	$sql = "select id,name from questionnaire";
	return db_select ( $sql, $con );
}

/*
 * 功能：返回某个题库
 * $id：题型编号
 * $con：数据库连接
 * 返回值：数组
 */
function qst_get_questionnaire($id, $con) {
	$sql = "select id,name from questionnaire where id=?";
	db_bind_param ( $sql, 1, $id, 'INT' );
	return db_select ( $sql, $con );
}

/*
 * 功能：添加某种题库
 * $name：题型名称
 * $con：数据库连接
 * 返回值：无
 */
function qst_add_questionnaire($name, $con) {
	$sql = "insert into questionnaire (name) values (?)";
	db_bind_param ( $sql, 1, $name, 'STRING' );
	return db_insert ( $sql, $con );
}

/*
 * 功能：删除某种题库
 * $id：题型编号
 * $con：数据库连接
 * 返回值：无
 */
function qst_remove_questionnaire($id, $con) {
	$sql = "delete from questionnaire where id=?";
	db_bind_param ( $sql, 1, $id, 'STRING' );
	return db_delete ( $sql, $con );
}

/*
 * 功能：获取所有问题
 * $questionnaire_id：题库编号
 * $con：数据库连接
 * 返回值：数组
 */
function qst_get_all_question($questionnaire_id, $con) {
	$sql = "select question.id,question.questionnaire_id,question.type_id,question.content,
 		questionnaire.name questionnaire,type.name type from question
 		inner join questionnaire on questionnaire.id=question.questionnaire_id
 		inner join type on type.id=question.type_id";
	return db_select ( $sql, $con );
}

/*
 * 功能：获取某个问题
 * $id：题型编号
 * $con：数据库连接
 * 返回值：数组
 */
function qst_get_question($id, $con) {
	$sql = "select question.id,question.questionnaire_id,question.type_id,question.content,
 		questionnaire.name questionnaire,type.name type from question
 		inner join questionnaire on questionnaire.id=question.questionnaire_id
 		inner join type on type.id=question.type_id where question.id=?";
	db_bind_param ( $sql, 1, $id, 'INT' );
	return db_select ( $sql, $con );
}

/*
 * 功能：添加某个问题
 * $questionnaire_id：题库编号
 * $type_id：题型编号
 * $content：题目内容
 * $con：数据库连接
 * 返回值：无
 */
function qst_add_question($questionnaire_id, $type_id, $content, $con) {
	$sql = "insert into question (questionnaire_id,type_id,content) values (?,?,?)";
	db_bind_param ( $sql, 1, $questionnaire_id, 'STRING' );
	db_bind_param ( $sql, 1, $type_id, 'STRING' );
	db_bind_param ( $sql, 1, $content, 'STRING' );
	return db_insert ( $sql, $con );
}

/*
 * 功能：删除某个问题
 * $id：题型编号
 * $con：数据库连接
 * 返回值：无
 */
function qst_remove_question($id, $con) {
	$sql = "delete from question where id=?";
	db_bind_param ( $sql, 1, $id, 'STRING' );
	return db_delete ( $sql, $con );
}
?>