<!-- charset=UTF-8 -->
<!-- 
  @功能：注册窗体
  @日期：2015-03-29
-->

<div class="container" style="margin-top: 50px;">
	<form class="form-horizontal" method="post"
		action="../common/register_status.php">
		<div class="form-group">
			<div class="col-md-offset-3 col-md-6">
		        <h2>用户注册</h2>
		    </div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-3 col-md-6">
		    <?php
						if ($status != null) {
							echo '<div class="alert alert-danger">' . $status . '</div>';
						}
						?>
		    </div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">用户名</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="username" required />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">密码</label>
			<div class="col-md-6">
				<input type="password" class="form-control" name="password" required />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">确认密码</label>
			<div class="col-md-6">
				<input type="password" class="form-control" name="confirm" required />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">姓名</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="name" required />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-default btn-block">注册</button>
			</div>
		</div>
	</form>
</div>