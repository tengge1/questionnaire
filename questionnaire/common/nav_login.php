<!-- charset=UTF-8 -->
<!-- 
  @功能：用户登录后导航栏右侧显示
  @日期：2015-03-29
-->

<ul class="nav navbar-nav navbar-right">
	<li class="dropdown"><a href="#" role="button" data-toggle="dropdown">
		<?php echo $_SESSION['name']; ?> <span class="caret"></span>
	</a>
		<ul class="dropdown-menu">
			<li><a href="../admin/change_password.php">修改密码</a></li>
			<li class="divider"></li>
			<li><a href="../admin/logout.php">注销</a></li>
		</ul></li>
</ul>