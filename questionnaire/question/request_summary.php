<?php session_start (); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：问卷统计汇总
  @日期：2015-03-29
-->

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>问卷统计汇总</title>
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
	$category = $_REQUEST ["category"];
	$request_id = $_REQUEST ["id"];
	include '../common/header.php';
	?>
	<?php
	$con = db_connect ( $db_server, $db_username, $db_password );
	db_select_db ( $db_name, $con );
	$sql = "SELECT request.id,request.`name` request,
        (SELECT COUNT(user_request.id) FROM user_request WHERE user_request.`request_id`=request.id) puts,
		(SELECT COUNT(user_request.id) FROM user_request WHERE user_request.`request_id`=request.id AND 
		user_request.`submit`=1) gets FROM request WHERE request.id=?";
	db_bind_param ( $sql, 1, $request_id, 'INT' );
	$array = db_select ( $sql, $con );
	$request = $array [0];
	?>
	<div class="container">
		<h3>问卷信息</h3>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>问卷编号</th>
					<th>问卷名称</th>
					<th>发出问卷</th>
					<th>收回问卷</th>
					<th>回收率</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $request["id"]; ?></td>
					<td><?php echo $request["request"]; ?></td>
					<td><?php echo $request["puts"]; ?></td>
					<td><?php echo $request["gets"]; ?></td>
					<td><?php echo (floatval($request["gets"])/floatval($request["puts"])*100).'%'; ?></td>
				</tr>
			</tbody>
		</table>
		<h3>问卷汇总</h3>
		<?php
		$sql = "SELECT question.id,question.`questionnaire_id`,question.`type_id`,question.`content`,
		type.`name` `type` FROM question
		INNER JOIN `type` ON type.`id`=question.`type_id`
		INNER JOIN request_question ON request_question.`question_id`=question.`id`
		INNER JOIN user_request ON user_request.`request_id`=request_question.`request_id`
		WHERE user_request.`id`=?";
		db_bind_param ( $sql, 1, $_REQUEST ["id"], 'INT' );
		$array = db_select ( $sql, $con );
		?>
	<form method="post" class="form-horizontal" action="#">
			<input type="hidden" name="user_request_id"
				value="<?php echo $id; ?>" />
				<?php
				// 输出题干和选项
				for($i = 0; $i < count ( $array ); $i ++) {
					$item = $array [$i];
					echo '<div class="form-group">';
					echo '<label class="col-md-1 control-label">' . ($i + 1) . '</label>';
					echo '<div class="col-md-11">';
					echo '<p class="form-control-static">' . $item ['content'] . '</p>';
					echo '</div>';
					// 输出选项
					if ($item ["type"] == "选择题") {
						$sql1 = "SELECT options.option_id,options.content,(SELECT COUNT(*) 
		                     FROM answer WHERE answer.`question_id`=options.`question_id` AND answer.`content`=options.`option_id`) count
                             FROM options WHERE options.question_id=?";
						db_bind_param ( $sql1, 1, $item ["id"], 'INT' );
						$array1 = db_select ( $sql1, $con );
						foreach ( $array1 as $item1 ) {
							echo '<p class="form-control-static col-md-11 col-md-offset-1">' . $item1 ["option_id"] . '  ' . $item1 ["content"] . '('.$item1["count"].'次)</p>';
						}
					} else { // 填空题
						$sql1 = "SELECT content,COUNT(*) count FROM answer 
                            GROUP BY question_id,content HAVING question_id=?";
						db_bind_param ( $sql1, 1, $item ["id"], 'INT' );
						$array1 = db_select ( $sql1, $con );
						foreach($array1 as $item1) {
							echo '<p class="form-control-static col-md-11 col-md-offset-1">' . $item1 ["content"] . '  (' . $item1 ["count"] . '次)</p>';
						}
					}
					// 关闭form-group
					echo '</div>';
				}
				?>
				</form>
	</div>
	
	<?php db_close($con); ?>
	
	<?php include '../common/bootstrap_js.php'; ?>
</body>
</html>