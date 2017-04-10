<?php session_start (); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：统计汇总
  @日期：2015-03-29
-->

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>系统信息</title>
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
	$con = db_connect ( $db_server, $db_username, $db_password );
	db_select_db ( $db_name, $con );
	?>
	<div class="container">
	    <h4>环境变量</h4>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th style="width: 100px;">键</th>
					<th>值</th>
				</tr>
			</thead>
			<tbody>
			    <?php
							foreach ( array_keys ( $_ENV ) as $key ) {
								echo '<tr>';
								echo '<td>' . $key . '</td>';
								echo '<td>' . $_SERVER [$key] . '</td>';
								echo '</tr>';
							}
							?>
			</tbody>
		</table>
		<h4>服务器变量</h4>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th style="width: 100px;">键</th>
					<th>值</th>
				</tr>
			</thead>
			<tbody>
			    <?php
							foreach ( array_keys ( $_SERVER ) as $key ) {
								echo '<tr>';
								echo '<td>' . $key . '</td>';
								echo '<td>' . $_SERVER [$key] . '</td>';
								echo '</tr>';
							}
							?>
			</tbody>
		</table>
		<h4>请求变量</h4>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th style="width: 100px;">键</th>
					<th>值</th>
				</tr>
			</thead>
			<tbody>
			    <?php
							foreach ( array_keys ( $_REQUEST ) as $key ) {
								echo '<tr>';
								echo '<td>' . $key . '</td>';
								echo '<td>' . $_SERVER [$key] . '</td>';
								echo '</tr>';
							}
							?>
			</tbody>
		</table>
		<h4>COOKIE变量</h4>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th style="width: 100px;">键</th>
					<th>值</th>
				</tr>
			</thead>
			<tbody>
			    <?php
							foreach ( array_keys ( $_COOKIE ) as $key ) {
								echo '<tr>';
								echo '<td>' . $key . '</td>';
								echo '<td>' . $_SERVER [$key] . '</td>';
								echo '</tr>';
							}
							?>
			</tbody>
		</table>
		<h4>SESSION变量</h4>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th style="width: 100px;">键</th>
					<th>值</th>
				</tr>
			</thead>
			<tbody>
			    <?php
							foreach ( array_keys ( $_SESSION ) as $key ) {
								echo '<tr>';
								echo '<td>' . $key . '</td>';
								echo '<td>' . $_SERVER [$key] . '</td>';
								echo '</tr>';
							}
							?>
			</tbody>
		</table>
		<h4>数据统计</h4>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th style="width: 100px;">类别</th>
					<th>数量</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>题型总数</td>
					<td><?php echo count(qst_get_all_type($con)); ?></td>
				</tr>
				<tr>
					<td>题库总数</td>
					<td><?php echo count(qst_get_all_questionnaire($con)); ?></td>
				</tr>
				<tr>
					<td>用户组总数</td>
					<td><?php echo count(grp_get_all_group($con)); ?></td>
				</tr>
				<tr>
					<td>用户总数</td>
					<td><?php echo count(usr_get_all_user($con)); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<?php db_close($con); ?>
	
	<?php include '../common/bootstrap_js.php'; ?>
</body>
</html>