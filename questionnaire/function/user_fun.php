<!-- charset=UTF-8 -->
<!-- 
  @功能：用户常用函数
  @日期：2015-03-29
-->

<?php
/*
 * 功能：获取所有用户
 * $con：数据库连接
 * 返回值：数组
 */
function usr_get_all_user($con) {
	$sql = "select id,username,name,admin from user";
	return db_select ( $sql, $con );
}

/*
 * 功能：返回某个用户
 * $id：用户编号
 * $con：数据库连接
 * 返回值：数组
 */
function usr_get_user($id, $con) {
	$sql = "select id,username,name,admin from user where id=?";
	db_bind_param ( $sql, 1, $id, 'INT' );
	return db_select ( $sql, $con );
}

/*
 * 功能：添加某个用户
 * $username：用户名
 * $password：用户密码
 * $name：姓名
 * $admin：是否是管理员
 * $con：数据库连接
 * 返回值：无
 */
function usr_add_user($username, $password, $name, $admin, $con) {
	$sql = "insert into user (username,password,name,admin) values (?,?,?,?)";
	db_bind_param ( $sql, 1, $username, 'STRING' );
	db_bind_param ( $sql, 1, $password, 'STRING' );
	db_bind_param ( $sql, 1, $name, 'STRING' );
	db_bind_param ( $sql, 1, $admin, 'STRING' );
	return db_insert ( $sql, $con );
}

/*
 * 功能：删除某个用户
 * $id：用户编号
 * $con：数据库连接
 * 返回值：无
 */
function usr_remove_user($id, $con) {
	$sql = "delete from user where id=?";
	db_bind_param ( $sql, 1, $id, 'STRING' );
	return db_delete ( $sql, $con );
}
?>