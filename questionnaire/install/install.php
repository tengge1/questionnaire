<!-- charset=UTF-8 -->
<!-- 
  @功能：网站安装文件
  @日期：2015-03-29
  @注意：安装时请手工创建$db_name所示的数据库，安装完成后请删除该文件
-->

<?php
// 页面显示编码
header ( "Content-Type: text/html; charset=UTF-8" );
echo '正在安装，请稍后...<br />';

// 导入数据库配置文件
include_once '../config/config.php';

// 导入所有函数
include_once '../function/fun.php';

// 连接数据库
$con = db_connect ( $db_server, $db_username, $db_password );

// 删除数据库
db_drop_db ( $db_name, $con );

// 重建数据库
db_create_db ( $db_name, $con );

// 选择数据库
db_select_db ( $db_name, $con );

// 创建用户表（编号、用户名、密码、姓名，是否是管理员）
$sql = "create table user (
		id int not null auto_increment,
		primary key (id),
		username varchar(100),
		password varchar(100),
		name varchar(100),
		admin int
		)";
db_create_table ( $sql, $con );

// 创建用户组表（编号、用户组名称）
$sql = "create table groups (
				id int not null auto_increment,
				primary key(id),
				name varchar(100)
				)";
db_create_table ( $sql, $con );

// 创建用户分组表（编号、用户编号、用户组编号）
$sql = "create table user_groups (
						id int not null auto_increment,
						primary key(id),
						user_id int,
						groups_id int
						);";
db_create_table ( $sql, $con );

// 创建题库表（编号，用户编号，名称）
$sql = "create table questionnaire (
						id int not null auto_increment,
						primary key(id),
						user_id int,
						name varchar(100)
						)";
db_create_table ( $sql, $con );

// 创建题型管理表
$sql = "create table type (
								id int not null auto_increment,
								primary key(id),
								name varchar(100)
								);";
db_create_table ( $sql, $con );

// 创建问题表（编号，题型，内容）
$sql = "create table question (
								id int not null auto_increment,
								primary key(id),
								questionnaire_id int,
								type_id int,
								content varchar(1000)
								);";
db_create_table ( $sql, $con );

// 创建选项表（编号，问题编号，选项编号，选项内容）
$sql = "create table options (
										id int not null auto_increment,
										primary key(id),
										question_id int,
										option_id varchar(100),
										content varchar(1000)
										);";
db_create_table ( $sql, $con );

// 创建答题表（编号，题库编号，用户编号，日期）
$sql = "create table response (
												id int not null auto_increment,
												primary key(id),
												user_request_id int,
												date varchar(100)
												);";
db_create_table ( $sql, $con );

// 创建答题题目表（编号，答题表编号，问题编号，答案）
$sql = "create table answer (
														id int not null auto_increment,
														primary key(id),
														response_id int,
														question_id int,
														pos int,
														content varchar(1000)
														);";
db_create_table ( $sql, $con );

// 创建问卷表
$sql = "create table request (
																id int not null auto_increment,
																primary key(id),
																name varchar(100)
																);";
db_create_table ( $sql, $con );

// 创建问卷题目表
$sql = "create table request_question (
																id int not null auto_increment,
																primary key(id),
																request_id int,
																question_id int
																);";
db_create_table ( $sql, $con );

// 创建用户问卷表
$sql = "create table user_request (
																		id int not null auto_increment,
																		primary key(id),
																		user_id int,
																		request_id int,
																		submit int
																		);";
db_create_table ( $sql, $con );

// 初始化用户表数据
$sql = "insert into user (
		username,password,name,admin) 
		values (?,?,'管理员',1)";
db_bind_param ( $sql, 1, $admin_username, 'STRING' );
db_bind_param ( $sql, 1, $admin_password, 'STRING' );
db_insert ( $sql, $con );

// 初始化用户组表
$sql = "insert into groups (name) values ('管理员组')";
db_insert ( $sql, $con );
$sql = "insert into groups (name) values ('普通用户组')";
db_insert ( $sql, $con );

// 初始化题库表数据
$sql = "insert into questionnaire (user_id,name) values ('1','示例题库')";
db_insert ( $sql, $con );

// 初始化题型表
$sql = "insert into type (name) values ('选择题'),('填空题')";
db_insert ( $sql, $con );

// 初始化问题表
$sql = "insert into question (questionnaire_id,type_id,content) values (1,1,?)";
db_bind_param ( $sql, 1, '____规定一个类应该只有一个发生变化的原因。', 'STRING' );
db_insert ( $sql, $con );
$sql = "insert into question (questionnaire_id,type_id,content) values (1,2,?)";
db_bind_param ( $sql, 1, '香港是____年回归祖国的。', 'STRING' );
db_insert ( $sql, $con );

// 初始化选项表
$sql = "insert into options (question_id,option_id,content) values ('1','A','单一职责原则');";
db_insert ( $sql, $con );

$sql = "insert into options (question_id,option_id,content) values ('1','B','开闭原则');";
db_insert ( $sql, $con );

$sql = "insert into options (question_id,option_id,content) values ('1','C','依赖倒置原则');";
db_insert ( $sql, $con );

// 初始化用户问卷表数据
$sql = "insert into user_request (user_id,request_id,submit) values (1,1,0)";
db_insert ( $sql, $con );

// 初始化答题表
$sql = "insert into response (user_request_id,date) values (1,'2015-03-30 23:13:45')";
db_insert ( $sql, $con );

// 创建答题题目表
$sql = "insert into answer (response_id,question_id,pos,content) values (1,1,1,'A')";
db_insert ( $sql, $con );
$sql = "insert into answer (response_id,question_id,pos,content) values (1,2,1,'1997')";
db_insert ( $sql, $con );

// 初始化问卷表
$sql = "insert into request (name) values (?);";
db_bind_param ( $sql, 1, '示例问卷', 'STRING' );
db_insert ( $sql, $con );

// 初始化问卷题目表
$sql = "insert into request_question (request_id,question_id) values (1,1),(1,2);";
db_insert ( $sql, $con );

// 关闭数据库连接
db_close ( $con );

// 输出安装完成
echo "恭喜您，安装成功！";
?>