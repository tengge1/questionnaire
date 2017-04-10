<!-- charset=UTF-8 -->
<!-- 
  @功能：管理员具有的导航栏菜单
  @日期：2015-03-29
-->

<li
	<?php if($category=='题型管理'||$category=='题库管理') echo 'class="active"'; ?>><a
	href="#" class="dropdown-toggle" data-toggle="dropdown">题库管理 <span
		class="caret"></span></a>
	<ul class="dropdown-menu">
		<li <?php if($category=='题型管理') echo 'class="active"'; ?>><a
			href="../question/type.php?category=题型管理">题型管理</a></li>
		<li <?php if($category=='题库管理') echo 'class="active"'; ?>><a
			href="../question/questionnaire.php?category=题库管理">题库管理</a></li>
	</ul></li>
<li <?php if($category=='问卷管理') echo 'class="active"'; ?>><a href="../question/request.php?category=问卷管理">问卷管理</a>
</li>
<li <?php if($category=='系统信息') echo 'class="active"'; ?>><a
	href="../question/summary.php?category=系统信息">系统信息</a></li>
<li class="dropdown"
	<?php if($category=='用户组管理'||$category=='用户管理') echo 'class="active"'; ?>>
	<a class="dropdown-toggle" href="#" data-toggle="dropdown"> 权限管理 <span
		class="caret"></span>
</a>
	<ul class="dropdown-menu">
		<li <?php if($category=='用户组管理') echo 'class="active"'; ?>><a
			href="../admin/group.php?category=用户组管理">用户组管理</a></li>
		<li <?php if($category=='用户管理') echo 'class="active"'; ?>><a
			href="../admin/user.php?category=用户管理">用户管理</a></li>
	</ul>
</li>