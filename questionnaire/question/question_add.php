<?php session_start(); ?>
<!-- charset=UTF-8 -->
<!-- 
  @功能：添加题目
  @日期：2015-03-29
-->

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>添加题目</title>
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
	$category = "题库管理";
	$questionnaire_id = $_REQUEST ["questionnaire_id"];
	?>
<div class="container">
		<form class="form-horizontal" id="form-add-question" method="post"
			action="../common/question_add_status.php">
			<div class="form-group">
				<div class="col-md-offset-3 col-md-6">
					<h4>添加题目</h4>
					<input type="hidden" name="questionnaire_id"
						value="<?php echo $questionnaire_id; ?>" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-6">
		    <?php
						$status = $_REQUEST ["status"];
						if ($status != null) {
							echo '<div class="alert alert-danger">' . $status . '</div>';
						}
						?>
		    </div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">题型</label>
				<div class="col-md-6">
					<div class="radio">
						<label> <input type="radio" name="type" id="type-choice"
							value="选择题" checked>选择题
						</label>
					</div>
					<div class="radio">
						<label> <input type="radio" name="type" id="type-blank"
							value="填空题">填空题
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">题干</label>
				<div class="col-md-6">
					<textarea class="form-control" name="content" rows="3"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">选项</label>
				<div class="col-md-6">
					<button type="button" class="btn btn-primary" id="btn-add-option">
						<span class="glyphicon glyphicon-plus"></span> 增加选项
					</button>
					<button type="button" class="btn btn-default" id="btn-minus-option"
						disabled>
						<span class="glyphicon glyphicon-minus"></span> 减少选项
					</button>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6 col-md-offset-3">
					<div class="input-group">
						<span class="input-group-addon">A</span> <input type="text"
							class="form-control" name="option-A" />
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6 col-md-offset-3">
					<div class="input-group">
						<span class="input-group-addon">B</span> <input type="text"
							class="form-control" name="option-B" />
					</div>
				</div>
			</div>
			<div class="form-group" id="div-add-question">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-default btn-block">添加题目</button>
				</div>
			</div>
		</form>
	</div>
	
	<?php include '../common/bootstrap_js.php'; ?>
	<script>
        $("#type-choice").click(function(){//选择了选择题，显示第五到倒数第二个form-group
        	var count=$("#form-add-question>div").size();
            $("#form-add-question>div").each(function(i,n){
                if(i>=4&&i<count-1){
                    $(this).show();
                    }
                });
            });
        $("#type-blank").click(function(){//选择了填空题，隐藏第五个到倒数第二个form-group
            var count=$("#form-add-question>div").size();
            $("#form-add-question>div").each(function(i,n){
                if(i>=4&&i<count-1){
                    $(this).hide();
                    }
                });
            });
        $("#btn-add-option").click(function(){
            var letters=['A','B','C','D','E','F','G','H','I','J','K','L','M','N'];
            var count=$("#form-add-question>div").size();
            var letter=letters[count-letters.length+8];
            if(count<20){
                $("#div-add-question").before('<div class="form-group">'
        				+'<div class="col-md-6 col-md-offset-3">'
    					+'<div class="input-group">'
    					+'<span class="input-group-addon">'+letter+'</span>'
    					+'<input type="text" class="form-control" name="option-'+letter+'" />'
    					+'</div></div></div>');
                }
            if(count==19){
            	$("#btn-add-option").attr("disabled","true");
                }
            if(count>=7){
                $("#btn-minus-option").removeAttr("disabled");
                }
            });
        $("#btn-minus-option").click(function(){
        	var count=$("#form-add-question>div").size();
        	$("#form-add-question>div:eq("+(count-2)+")").remove();
        	if(count==9){
        		$("#btn-minus-option").attr("disabled","true");
        		return;
            	}
        	if(count<21){
        		$("#btn-add-option").removeAttr("disabled");
            	}
            });
	</script>
</body>
</html>