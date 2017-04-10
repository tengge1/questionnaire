<?php session_start (); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：填写问卷
  @日期：2015-03-29
-->

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>填写问卷</title>
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
	$id = $_REQUEST ["id"];
	$category = $_REQUEST ["category"];
	include '../common/header.php';
	?>
	<?php
	$con = db_connect ( $db_server, $db_username, $db_password );
	db_select_db ( $db_name, $con );
	$sql = "SELECT question.id,question.`questionnaire_id`,question.`type_id`,question.`content`,
		type.`name` `type` FROM question
		INNER JOIN `type` ON type.`id`=question.`type_id`
		INNER JOIN request_question ON request_question.`question_id`=question.`id`
		INNER JOIN user_request ON user_request.`request_id`=request_question.`request_id`
		WHERE user_request.`id`=?";
	db_bind_param ( $sql, 1, $_REQUEST ["id"], 'INT' );
	$array = db_select ( $sql, $con );
	?>
	<div class="container">
		<form method="post" class="form-horizontal"
			action="../common/response_status.php">
			<input type="hidden" name="user_request_id"
				value="<?php echo $id; ?>" />
				<?php
				// 输出题干和选项
				for($i = 0; $i < count ( $array ); $i ++) {
					$item = $array [$i];
					echo '<div class="form-group">';
					echo '<label class="col-md-2 control-label">' . ($i + 1) . '</label>';
					echo '<div class="col-md-10">';
					echo '<p class="form-control-static">' . $item ['content'] . '</p>';
					echo '</div>';
					// 输出选项
					if ($item ["type"] == "选择题") {
						$sql1 = "select option_id,content from options where question_id=?";
						db_bind_param ( $sql1, 1, $item ["id"], 'STRING' );
						$array1 = db_select ( $sql1, $con );
						foreach ( $array1 as $item1 ) {
							echo '<div class="col-md-10 col-md-offset-2">';
							echo '<div class="checkbox">';
							echo '<label> <input type="checkbox" name="question_' . $item ["id"] . '[]" value="' . $item1 ["option_id"] . '">';
							echo $item1 ["content"];
							echo '</label>';
							echo '</div>';
							echo '</div>';
						}
					} else { // 填空题
						$count = substr_count ( $item ["content"], '____' );
						for($j = 0; $j < $count; $j ++) {
							echo '<div class="col-md-10 col-md-offset-2" style="margin-top: 10px;">';
							echo '<div class="input-group">';
							echo '<span class="input-group-addon">' . ($j + 1) . '</span>';
							echo '<input type="text" class="form-control input-sm" name="question_' . $item ["id"] . '[]" value="" />';
							echo '</div>';
							echo '</div>';
						}
					}
					// 关闭form-group
					echo '</div>';
				}
				?>
	
	
	
	
	</div>
	<div class="form-group">
		<div class="col-md-10 col-md-offset-2">
			<button type="submit" class="btn btn-default">提交</button>
		</div>
	</div>
	</form>
	</div>
	
	<?php include '../common/bootstrap_js.php'; ?>
</body>
</html>