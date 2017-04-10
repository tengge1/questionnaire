<!-- charset=UTF-8 -->
<!-- 
  @功能：数据库常用函数定义
  @日期：2015-03-29
-->

<?php
/*
 * 功能：输出数据库错误
 * 返回值：无
 */
function db_error() {
	die ( "错误：" . mysql_error () );
}

/*
 * 功能：连接数据库
 * $db_server：数据库服务器IP地址
 * $db_username：数据库用户名
 * $db_password：数据库密码
 * 返回值：数据库连接
 */
function db_connect($db_server, $db_username, $db_password) {
	$con = mysql_connect ( $db_server, $db_username, $db_password );
	if (! $con) {
		db_error ();
	}
	return $con;
}

/*
 * 功能：关闭数据库
 * $con：数据库连接
 * 返回值：无
 */
function db_close($con) {
	mysql_close ( $con );
}

/*
 * 功能：执行sql语句
 * $query：sql语句
 * $con：数据库连接
 * 返回值：sql执行结果
 */
function db_query($query, $con) {
	$query = mysql_query ( $query, $con );
	if (! $query) {
		db_error ();
	}
	return $query;
}

/*
 * 功能：创建数据库（仅root账户有效）
 * $db_name：数据库名称
 * $con：数据库连接
 * 返回值：无
 */
function db_create_db($db_name, $con) {
	db_query ( "create database " . $db_name, $con );
}

/*
 * 功能：删除数据库（仅root账户有效）
 * $db_name：数据库名称
 * $con：数据库连接
 * 返回值：无
 */
function db_drop_db($db_name, $con) {
	db_query ( "drop database if exists " . $db_name, $con );
}

/*
 * 功能：选择数据库
 * $db_name：数据库名称
 * $con：数据库连接
 * 返回值：无
 */
function db_select_db($db_name, $con) {
	mysql_select_db ( $db_name, $con );
}

/*
 * 功能：创建表
 * $sql：sql语句
 * $con：数据库连接
 * 返回值：无
 */
function db_create_table($sql, $con) {
	db_query ( $sql, $con );
}

/*
 * 功能：插入记录
 * $sql：sql语句
 * $con：数据库连接
 * 返回值：无
 */
function db_insert($sql, $con) {
	db_query ( $sql, $con );
}

/*
 * 功能：选择记录
 * $sql：sql语句
 * $con：数据库连接
 * 返回值：查询结果数组
 */
function db_select($sql, $con) {
	$result = db_query ( $sql, $con );
	$array = array ();
	while ( $row = mysql_fetch_array ( $result ) ) {
		array_push ( $array, $row );
	}
	return $array;
}

/*
 * 功能：更新数据库记录
 * $sql：sql语句
 * $con：数据库连接
 * 返回值：无
 */
function db_update($sql, $con) {
	db_query ( $sql, $con );
}

/*
 * 功能：删除数据库记录
 * $sql：sql语句
 * $con：数据库连接
 * 返回值：无
 */
function db_delete($sql, $con) {
	db_query ( $sql, $con );
}

/*
 * 功能：数据库参数绑定
 * $sql：sql语句（引用传递）
 * $location：问号位置（从1开始）
 * $var：要绑定的值
 * $type：绑定类型
 * 返回值：无
 */
function db_bind_param(&$sql, $location, $var, $type) {
	switch ($type) {
		default :
		case 'STRING' :
		case 'STR' :
			$var = addslashes ( $var );
			$var = "'" . $var . "'";
			break;
		case 'INTEGER' :
		case 'INT' :
			$var = ( int ) $var;
	}
	for($i = 1, $pos = 0; $i <= $location; $i ++) {
		$pos = strpos ( $sql, '?', $pos + 1 );
	}
	$sql = substr ( $sql, 0, $pos ) . $var . substr ( $sql, $pos + 1 );
}
?>