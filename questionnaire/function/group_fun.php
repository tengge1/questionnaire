<!-- charset=UTF-8 -->
<!-- 
  @功能：用户组常用函数
  @日期：2015-03-29
-->

<?php
/*
 * 功能：获取所有用户组
 * $con：数据库连接
 * 返回值：数组
 */
function grp_get_all_group($con) {
	$sql = "select id,name from groups";
	return db_select ( $sql, $con );
}

/*
 * 功能：返回某个用户组
 * $id：用户组编号
 * $con：数据库连接
 * 返回值：数组
 */
function grp_get_group($id, $con) {
	$sql = "select id,name from groups where id=?";
	db_bind_param ( $sql, 1, $id, 'INT' );
	return db_select ( $sql, $con );
}

/*
 * 功能：添加某个用户组
 * $name：用户组名称
 * $con：数据库连接
 * 返回值：无
 */
function grp_add_group($name, $con) {
	$sql = "insert into groups (name) values (?)";
	db_bind_param ( $sql, 1, $name, 'STRING' );
	return db_insert ( $sql, $con );
}

/*
 * 功能：删除某个用户组
 * $id：用户组编号
 * $con：数据库连接
 * 返回值：无
 */
function grp_remove_group($id, $con) {
	$sql = "delete from groups where id=?";
	db_bind_param ( $sql, 1, $id, 'STRING' );
	return db_delete ( $sql, $con );
}
?>