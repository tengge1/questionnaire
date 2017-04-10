<?php session_start(); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：问卷题目表
  @日期：2015-03-29
-->

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>问卷题目管理</title>
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
				$questionnaire_id = $_REQUEST ["questionnaire_id"];
				if ($questionnaire_id == null) {
					$questionnaire_id = '';
				}
				?>
	<?php
	$category = '问卷管理';
	include '../common/header.php';
	?>
	<div class="container">
	<?php
	$con = db_connect ( $db_server, $db_username, $db_password );
	db_select_db ( $db_name, $con );
	$sql = "SELECT question.id,question.type_id,question.`questionnaire_id`,question.content,type.`name` type,
		questionnaire.`name` questionnaire,
		(CASE WHEN EXISTS(SELECT request_question.id FROM request_question 
		WHERE request_question.`question_id`=question.`id` AND request_question.`request_id`=?) THEN 1 ELSE 0 END) 
		contain FROM question INNER JOIN type ON type.id=question.`type_id`
		INNER JOIN questionnaire ON questionnaire.id=question.`questionnaire_id`";
	db_bind_param ( $sql, 1, $_REQUEST ["request_id"], 'INT' );
	$array = db_select ( $sql, $con );
	echo '<h4>问卷题目管理</h4>';
	echo '<form method="POST" class="form" action="../common/request_detail_status.php">';
	echo '<input type="hidden" name="request_id" value="'.$_REQUEST["request_id"].'" />';
	echo '<table class="table table-striped table-bordered table-hover" style="margin-top:20px;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th style="width:60px;">选择</th>';
	echo '<th style="width:60px;">编号</th>';
	echo '<th>题库</th>';
	echo '<th>题型</th>';
	echo '<th>内容</th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	
	foreach ( $array as $type ) {
		echo '<tr>';
		echo '<td><input type="checkbox" name="questions[]" value="' . $type ["id"] . '" ' . ($type ['contain'] == 1 ? 'checked' : '') . ' /></td>';
		echo '<td>' . $type ["id"] . '</td>';
		echo '<td>' . $type ["questionnaire"] . '</td>';
		echo '<td>' . $type ["type"] . '</td>';
		echo '<td>' . $type ["content"] . '</td>';
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	echo '<button type="submit" class="btn btn-default">保存问卷</button>';
	echo '</form>';
	?>
	</div>
	
	<?php include '../common/bootstrap_js.php'; ?>
</body>
</html>