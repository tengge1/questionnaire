<!-- charset=UTF-8 -->
<!-- 
  @功能：登录窗体
  @日期：2015-03-29
-->

<div class="container" style="margin-top: 50px;">
	<form class="form-horizontal" method="post"
		action="../common/login_status.php">
		<div class="form-group">
			<div class="col-md-offset-4 col-md-4">
				<h2 class="form-control-static">问卷调查</h2>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-4 col-md-4">
		    <?php
						$status = $_REQUEST ["status"];
						if ($status != null) {
							echo '<div class="alert alert-danger">' . $status . '</div>';
						}
						?>
		    </div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-4">用户名</label>
			<div class="col-md-4">
				<input type="text" class="form-control" name="username" required
					autofocus />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-4">密码</label>
			<div class="col-md-4">
				<input type="password" class="form-control" name="password" required />
			</div>
		</div>
		<!-- 		<div class="form-group">
			<div class="col-md-offset-4 col-md-4">
				<div class="checkbox">
					<label> <input type="checkbox" /> 记住密码
					</label>
				</div>
			</div>
		</div> -->
		<div class="form-group">
			<div class="col-md-offset-4 col-md-2">
				<button type="submit" class="btn btn-primary btn-block">登录</button>
			</div>
			<div class="col-md-2">
				<a href="../admin/register.php" class="btn btn-default btn-block">注册</a>
			</div>
		</div>
	</form>
</div>