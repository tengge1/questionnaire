<?php session_start (); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：需要填写的问卷列表
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
	include '../common/header.php';
	?>
	<?php
	// 这里面放置问题列表
	$con = db_connect ( $db_server, $db_username, $db_password );
	db_select_db ( $db_name, $con );
	$sql = "SELECT user_request.id,request.name request FROM user_request
		INNER JOIN `user` ON user_request.`user_id`=user.`id`
		INNER JOIN request ON user_request.`request_id`=request.id
		WHERE user.`username`=? and user_request.submit is null;";
	db_bind_param ( $sql, 1, $_SESSION ["username"], 'STRING' );
	$array = db_select ( $sql, $con );
	?>
	<div class="container">
		<h4>请您填写以下问卷并提交：</h4>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th style="width: 60px;">编码</th>
					<th>问卷</th>
					<th style="width: 60px;"></th>
				</tr>
			</thead>
			<tbody>
			    <?php
							foreach ( $array as $value ) {
								echo '<tr>';
								echo '<td>' . $value ["id"] . '</td>';
								echo '<td>' . $value ["request"] . '</td>';
								echo '<td><a href="response.php?id=' . $value ["id"] . '&category=填写问卷">答题</a></td>';
								echo '</tr>';
							}
							?>
			</tbody>
		</table>
	</div>
	
	<?php include '../common/bootstrap_js.php'; ?>
</body>
</html>