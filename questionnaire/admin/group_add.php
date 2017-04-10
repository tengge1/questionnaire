<?php session_start(); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：添加用户组
  @日期：2015-03-29
-->

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>添加用户组</title>
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
			action="../common/group_add_status.php">
			<div class="form-group">
				<div class="col-md-offset-3 col-md-6">
		    <?php
						$status = $_REQUEST ["status"];
						if ($status != null) {
							echo '<div class="alert alert-danger">' . $status . '</div>';
						}
						?>
		    </div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">用户组名称</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="name" required />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-default btn-block">添加</button>
				</div>
			</div>
		</form>
	</div>
	
	<?php include '../common/bootstrap_js.php'; ?>
</body>
</html>