<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = '管理员登录';
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/assets/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/assets/admin/lib/respond.min.js"></script>
<![endif]-->
<link href="/assets/admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="/assets/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title><?php echo   Html::encode($this->title);  ?></title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">

      <?php  $form = ActiveForm::begin([
          'fieldConfig' => [
              'template' => '<div class="field-row">{label}{input}</div>{error}'
          ],
          'options'=>[
              'class'=>'form form-horizontal',
          ],
      ]); ?>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
            <?php   echo $form->field($model,'username')->textInput(['class'=>'input-text size-L','placeholder'=>'用户名或邮箱'])->label(false); ?>

<!--          <input id="" name="" type="text" placeholder="账户" class="input-text size-L">-->
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
            <?php   echo $form->field($model,'password')->passwordInput(['class'=>'input-text size-L','placeholder'=>'请输入密码'])->label(false);?>
<!--          <input id="" name="" type="password" placeholder="密码" class="input-text size-L">-->
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
            <?php   echo $form->field($model,'verify')->passwordInput(['class'=>'input-text size-L','style'=>'width:150px;','placeholder'=>'验证码'])->label(false);?>
<!--          <input name="User[verify]" class="input-text size-L" type="text" placeholder="验证码" onblur="if(this.value==''){this.value='验证码:'}" onclick="if(this.value=='验证码:'){this.value='';}" value="验证码:" style="width:150px;">-->
           <img id="verifyImg" src="<?php echo Url::toRoute('user/captcha'); ?>"> <a id="kanbuq" href="javascript:;"></a> </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <label for="online">
            <input type="checkbox" name="User[rememerMe]" id="online" value="1">
            使我保持登录状态</label>
        </div>

      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
            <?php   echo Html::submitButton('登录',['class'=>'btn btn-success radius size-L']); ?>
            <?php   echo Html::submitButton('取消',['class'=>'btn btn-default radius size-L']); ?>
<!--          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">-->
<!--          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">-->
        </div>
      </div>
      <?php ActiveForm::end(); ?>

  </div>
</div>
<div class="footer">Copyright 你的公司名称 by H-ui.admin v3.1</div>
<script type="text/javascript" src="/assets/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/assets/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript">
    $(function () {
        //处理点击刷新验证码
        $("#verifyImg").on("click", function () {
            $.get("<?php echo Url::toRoute('user/captcha') ?>&refresh", function (data) {
                console.log(data);
                $("#verifyImg").attr("src", data["url"]);
            }, "json");
        });
    });
</script>

</body>
</html>