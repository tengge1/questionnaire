<?php session_start(); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：网站注销页面
  @日期：2015-03-29
-->

正在注销，请稍后...
<?php
include_once '../config/config.php';
include_once '../function/fun.php';
session_unset ();
session_write_close ();
echo '<script src="../res/js/navigate.js"></script>';
echo '<script type="text/javascript">navigate("../question/index.php",1000);</script>';
?>