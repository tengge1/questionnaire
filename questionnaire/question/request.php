<?php session_start(); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：问卷管理
  @日期：2015-03-29
-->

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>问卷管理</title>
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
	$status = $_REQUEST ["status"];
	if ($status != null) {
		if ($_REQUEST ["success"] == null) {
			echo '<div class="alert alert-danger">' . $status . '</div>';
		} else {
			echo '<div class="alert alert-success">' . $status . '</div>';
		}
	}
	?>
	<?php
	$con = db_connect ( $db_server, $db_username, $db_password );
	db_select_db ( $db_name, $con );
	$sql = "select id,name from request";
	$array = db_select ( $sql, $con );
	echo '<h4 style="display:inline-block;">问卷管理&nbsp;&nbsp;<small>点击问卷可以查看该问卷的题目</small></h4>';
	echo '<a class="btn btn-default" style="float:right;" href="../question/request_add.php?category=问卷管理">添加问卷</a>';
	echo '<table class="table table-striped table-bordered table-hover" style="margin-top:20px;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th style="width:60px;">编号</th>';
	echo '<th>问卷</th>';
	echo '<th style="width:60px;"></th>';
	echo '<th style="width:60px;"></th>';
	echo '<th style="width:60px;"></th>';
	echo '<th style="width:60px;"></th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	
	foreach ( $array as $type ) 

	{
		echo '<tr>';
		echo '<td>' . $type ["id"] . '</td>';
		echo '<td><a href="../question/request_detail.php?category=问卷管理&request_id=' . $type ["id"] . '">' . $type ["name"] . '</a></td>';
		echo '<td><a href="../question/request_edit.php?category=问卷管理&id=' . $type ["id"] . '">修改</a></td>';
		echo '<td><a href="../question/request_remove.php?category=问卷管理&id=' . $type ["id"] . '">删除</a></td>';
		echo '<td><a href="../common/request_publish_status.php?category=问卷管理&id=' . $type ["id"] . '">发布</a></td>';
		echo '<td><a href="../question/request_summary.php?category=问卷管理&id=' . $type ["id"] . '">统计</a></td>';
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	?>
	</div>
	
	<?php include '../common/bootstrap_js.php'; ?>
</body>
</html>