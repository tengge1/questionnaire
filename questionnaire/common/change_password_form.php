<!-- charset=UTF-8 -->
<!-- 
  @功能：修改密码窗体
  @日期：2015-03-29
-->

<div class="container">
	<form class="form-horizontal" method="post"
		action="../common/change_password_status.php">
		<div class="form-group">
			<div class="col-md-offset-3 col-md-6">
		    <?php
						$status = $_REQUEST ["status"];
						$success = $_REQUEST ["success"];
						if ($status != null) {
							if ($success == 'true') {
								echo '<div class="alert alert-success">' . $status . '</div>';
							} else {
								echo '<div class="alert alert-danger">' . $status . '</div>';
							}
						}
						?>
		    </div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">原密码</label>
			<div class="col-md-6">
				<input type="password" class="form-control" name="old_password"
					required />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">新密码</label>
			<div class="col-md-6">
				<input type="password" class="form-control" name="new_password"
					required />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">确认密码</label>
			<div class="col-md-6">
				<input type="password" class="form-control" name="confirm_password"
					required />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-default btn-block">修改</button>
			</div>
		</div>
	</form>
</div>