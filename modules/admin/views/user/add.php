
<body>
<article class="page-container">
    <?php $form = yii\widgets\ActiveForm::begin([
             'fieldConfig' => [
              'template' => '<div class="field-row">{label}{input}</div>{error}'
          ],
          'options'=>[
              'class'=>'form form-horizontal',
              'id'=>'form-admin-add',
          ],
    ]);  ?>

	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员：</label>
		<div class="formControls col-xs-8 col-sm-9">
            <?php echo $form->field($model,'username')->textInput(['class'=>'input-text','placeholder'=>'管理员账号'])->label(false);?>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
            <?php echo $form->field($model,'password')->textInput(['class'=>'input-text','placeholder'=>'密码'])->label(false); ?>
        </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
            <?php echo $form->field($model,'repassword')->textInput(['class'=>'input-text','placeholder'=>'确认密码'])->label(false); ?>
        </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <?php echo $form->field($model, 'sex')->radioList(['1'=>'男','2'=>'女'],['class'=>'radio-box'])->label(false); ?>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
		<div class="formControls col-xs-8 col-sm-9">
            <?php echo $form->field($model,'phone')->textInput(['class'=>'input-text','placeholder'=>'手机号'])->label(false); ?>

        </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
		<div class="formControls col-xs-8 col-sm-9">
            <?php echo $form->field($model,'email')->textInput(['class'=>'input-text','placeholder'=>'@'])->label(false); ?>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">角色：</label>
		<div class="formControls col-xs-8 col-sm-9">
              <?php  echo $form->field($model, 'role')->dropDownList(['1'=>'超级管理员','2'=>'总编','3'=>'栏目主辑','4'=>'栏目编辑'], ['prompt'=>'请选择','style'=>'width:150px','class'=>'select-box'])->label(false)?>
			 </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">备注：</label>
		<div class="formControls col-xs-8 col-sm-9">
            <?php  echo $form->field($model, 'remark')->textarea(['rows'=>5,'cols'=>30,'class'=>'textarea'])->label(false) ?>
            <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
<!--			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">-->
            <?php echo yii\helpers\Html::submitButton('提交', ['class'=>'btn btn-primary radius','name' =>'submit-button']) ?>
            <?php echo yii\helpers\Html::resetButton('重置', ['class'=>'btn btn-primary radius','name' =>'submit-button']) ?>
		</div>

	</div>
<!--	</form>-->
    <?php yii\widgets\ActiveForm::end(); ?>
</article>


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">

</script> 
