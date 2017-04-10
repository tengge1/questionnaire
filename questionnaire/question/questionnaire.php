<?php session_start(); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：题库管理
  @日期：2015-03-29
-->

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>题库管理</title>
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
	$array = qst_get_all_questionnaire ( $con );
	echo '<h4 style="display:inline-block;">题库管理&nbsp;&nbsp;<small>点击题库可以查看该题库的题目</small></h4>';
	echo '<a class="btn btn-default" style="float:right;" href="../question/questionnaire_add.php?category=题库管理">添加题库</a>';
	echo '<table class="table table-striped table-bordered table-hover" style="margin-top:20px;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th style="width:60px;">编号</th>';
	echo '<th>题库</th>';
	echo '<th style="width:60px;"></th>';
	echo '<th style="width:60px;"></th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	
	foreach ( $array as $type ) 

	{
		echo '<tr>';
		echo '<td>' . $type ["id"] . '</td>';
		echo '<td><a href="../question/question.php?category=题库管理&questionnaire_id=' . $type ["id"] . '">' . $type ["name"] . '</a></td>';
		echo '<td><a href="../question/questionnaire_edit.php?category=题库管理&id=' . $type ["id"] . '">修改</a></td>';
		echo '<td><a href="../question/questionnaire_remove.php?category=题库管理&id=' . $type ["id"] . '">删除</a></td>';
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	?>
	</div>
	
	<?php include '../common/bootstrap_js.php'; ?>
</body>
</html>