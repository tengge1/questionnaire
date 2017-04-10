<!-- charset=UTF-8 -->
<!-- 
  @功能：提交问卷并跳转
  @日期：2015-03-29
-->

<?php
include_once '../config/config.php';
include_once '../function/fun.php';
echo '正在提交，请稍后...';
$user_request_id = $_REQUEST ["user_request_id"];
$con = db_connect ( $db_server, $db_username, $db_password );
db_select_db ( $db_name, $con );

// 插入问卷提交表
$sql = "insert into response (user_request_id,date) values (?,?);";
db_bind_param ( $sql, 1, $user_request_id, 'INT' );
db_bind_param ( $sql, 1, date ( 'y-m-d h:i:s', time () ), 'STRING' );
db_insert ( $sql, $con );

// 查询最后插入的response_id
$sql = "select id from response order by id desc";
$array = db_select ( $sql, $con );
$response_id = $array [0] ["id"];

// 添加所有答题
foreach ( array_keys ( $_REQUEST ) as $key ) {
	$pos = strpos ( $key, 'question' );
	if ($pos === 0) { // 键中以question开头
		$question_id = substr ( $key, 9 );
		$array1 = $_REQUEST [$key];
		$pos = 0;
		foreach ( $array1 as $answer ) {
			$sql = "insert into answer (response_id,question_id,pos,content) values (?,?,?,?);";
			db_bind_param ( $sql, 1, $response_id, 'INT' );
			db_bind_param ( $sql, 1, $question_id, 'INT' );
			db_bind_param ( $sql, 1, $pos, 'INT' );
			db_bind_param ( $sql, 1, $answer ["content"], 'STRING' );
			db_insert ( $sql, $con );
			$pos ++;
		}
	}
}

// 设置为已提交
$sql = "update user_request set submit=1 where id=?";
db_bind_param ( $sql, 1, $user_request_id, 'INT' );
db_update ( $sql, $con );

echo '<script>window.location="../question/index.php?category=填写问卷";</script>';
db_close ( $con );
?>