<?php session_start(); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：修改密码页面
  @日期：2015-03-29
-->

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>修改密码</title>
<?php include '../common/bootstrap_css.php'; ?>
</head>
<body>
	<?php
	include_once '../config/config.php';
	if ($_SESSION ["username"] == null) {
		echo '<script>window.location="../admin/login.php?category=填写问卷";</script>';
		exit ();
	}
	include_once '../function/fun.php';
	include '../common/header.php';
	include '../common/change_password_form.php';
	?>
	<?php include '../common/bootstrap_js.php'; ?>
</body>
</html>