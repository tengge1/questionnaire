<!-- charset=UTF-8 -->
<!-- 
  @功能：网站导航栏
  @日期：2015-03-29
-->

<?php
// 如果没有定义$category参数，则选择填写问卷选项卡
$category = $_REQUEST ["category"];
if ($category == null || $category == '') {
	$category = '填写问卷';
}
?>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<!-- 网站名称 -->
			<a class="navbar-brand" href="../question/index.php?category=填写问卷">
			<?php echo $web_name; ?></a>
		</div>
		<div class="collapse navbar-collapse">
			<!-- 在这里，我们定义了三个类别，如果希望添加新的类别，请修改这里 -->
			<ul class="nav navbar-nav">
				<li <?php if($category=='填写问卷') echo 'class="active"'; ?>><a
					href="../question/index.php?category=填写问卷">填写问卷</a></li>
				<?php
				if ($_SESSION ["username"] == 'admin') {
					include_once '../common/header_admin.php';
				}
				?>
			</ul>
			<?php
			if ($_SESSION ["username"] != null) {
				include_once 'nav_login.php';
			} else {
				include_once 'nav_logout.php';
			}
			?>
		</div>
	</div>
</nav>