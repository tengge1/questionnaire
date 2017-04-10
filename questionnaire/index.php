<?php session_start(); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：直接访问跳转到问卷调查首页
  @日期：2015-03-29
-->

<?php
include_once 'config/config.php';
if ($_SESSION ["username"] != null) {
	echo '<script>window.location="question/index.php?category=填写问卷";</script>';
} else {
	echo '<script>window.location="admin/login.php?category=填写问卷";</script>';
}
exit ();
?>