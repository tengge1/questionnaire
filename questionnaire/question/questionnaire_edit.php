<?php session_start(); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：修改题库
  @日期：2015-03-29
-->

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>修改题库</title>
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
		<form class="form-horizontal" method="post"
			action="../common/questionnaire_edit_status.php">
			<div class="form-group">
				<div class="col-md-offset-3 col-md-6">
		    <?php
						if ($status != null) {
							echo '<div class="alert alert-danger">' . $status . '</div>';
						}
						?>
		    </div>
			</div>
			<?php
			$con = db_connect ( $db_server, $db_username, $db_password );
			db_select_db ( $db_name, $con );
			$array = qst_get_questionnaire ( $_REQUEST ["id"], $con );
			if (count ( $array ) == 0) {
				die ( "不存在该题库" );
			}
			$type = $array [0];
			?>
			<input type="hidden" name="id" value="<?php echo $type["id"]; ?>" />
			<div class="form-group">
				<label class="control-label col-md-3">题库</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="name"
						value="<?php echo $type["name"]; ?>" required />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-default btn-block">修改</button>
				</div>
			</div>
		</form>
	</div>
	
	<?php include '../common/bootstrap_js.php'; ?>
</body>
</html>