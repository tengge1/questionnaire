<?php session_start (); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：用户管理
  @日期：2015-03-29
-->

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>用户管理</title>
<?php include_once '../common/bootstrap_css.php'; ?>
</head>
<body>
    <?php
				include_once '../config/config.php';
				if ($_SESSION ["username"] == null) {
					echo '<script>window.location="../admin/login.php?category=填写问卷";</script>';
					exit ();
				}
				include_once '../function/fun.php';
				?>
	<?php
	include '../common/header.php';
	?>
	<div class="container">
	<?php
	$con = db_connect ( $db_server, $db_username, $db_password );
	db_select_db ( $db_name, $con );
	$array = usr_get_all_user ( $con );
	echo '<h4 style="display:inline-block;">用户管理</h4>';
	echo '<a class="btn btn-default" style="float:right;" href="../admin/user_add.php?category=用户管理">添加用户</a>';
	echo '<table class="table table-striped table-bordered table-hover" style="margin-top:20px;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th style="width:60px;">编号</th>';
	echo '<th style="width:120px">用户名</th>';
	echo '<th>姓名</th>';
	echo '<th style="width:80px;">管理员</th>';
	echo '<th style="width:60px;"></th>';
	echo '<th style="width:60px;"></th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	
	foreach ( $array as $type ) 

	{
		echo '<tr>';
		echo '<td>' . $type ["id"] . '</td>';
		echo '<td>' . $type ["username"] . '</td>';
		echo '<td>' . $type ["name"] . '</td>';
		echo '<td>' . ($type ["admin"] == '1' ? "是" : "否") . '</td>';
		echo '<td><a href="../admin/user_edit.php?category=用户组管理&id=' . $type ["id"] . '">修改</a></td>';
		echo '<td><a href="../admin/user_remove.php?category=用户组管理&id=' . $type ["id"] . '">删除</a></td>';
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	?>
	</div>
	
	<?php include '../common/bootstrap_js.php'; ?>
</body>
</html>