<?php session_start(); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：网站登录页面
  @日期：2015-03-29
-->

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>登录</title>
<?php include '../common/bootstrap_css.php'; ?>
</head>
<body>
	<?php
	include_once '../config/config.php';
	include_once '../function/fun.php';
	include '../common/login_form.php';
	?>
	<?php include '../common/bootstrap_js.php'; ?>
</body>
</html>