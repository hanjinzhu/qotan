<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="renderer" content="webkit">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title?></title>
        <link href="/static/css/font-awesome.min.css" rel="stylesheet">
        <link href="http://cdn.bootcss.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="/static/css/style.css" rel="stylesheet">
        <link href="/static/css/login.css" rel="stylesheet">
    </head>
    <body class="login_bg">
    	<div class="navbar  navbar-fixed-top bs-docs-nav">
        	<div class="container">
        		<img src="/static/images/web/header_banner_logo.png" style="padding: 10px 0px 0px;width:20px;float:left;margin-right:8px;">
          		<a class="brand" href="/">离线阅读神器</a>
          		<img src="/static/images/web/header_banner.png" style="padding: 15px 0px 0px;">
      		</div>
      		<div class="color-line"></div>
		</div>	
        <div class="login-form-section" id="register_form">
            <div class="return_link">
                <a href="/"><i class="fa fa-arrow-left"></i>返回</a>
            </div>
            <div class="section-title">
                <h3>离线阅读账户注册</h3>
            </div>
            <div class="textbox-wrap">
                <div class="input-prepend">
                    <span class="add-on"><i class="fa fa-envelope"></i></span>
                    <input  type="text" placeholder="请输入电子邮箱" class="email" maxlength="50">
                </div>
            </div>
            <div class="textbox-wrap">
                <div class="input-prepend">
                    <span class="add-on"><i class="fa fa-user"></i></span>
                    <input type="text"  placeholder="用户昵称" class="nick" maxlength="20">
                </div>
            </div>
            <div class="textbox-wrap">
                <div class="input-prepend">
                    <span class="add-on"><i class="fa fa-key"></i></span>
                    <input  type="password" placeholder="请输入密码" class="password" maxlength="20">
                </div>
            </div>
            <div class="clearfix login-form-action">
                <button type="submit" class="green-btn submit_register" style="width:100%">注&nbsp;册</button>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="container register_success_info">
        	<p style="font-size:18px;"><i class="fa fa-check"></i> 注册成功</p>
            <p>感谢您注册和使用离线阅读，我们给您发送了验证邮件激活您的帐号。 <a href="" id="active_mail">前往<span class="who_mail"></span>邮箱激活</a> | <a href="/">返回首页</a></p>
        </div>
    </body>
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="/static/js/register.js"></script>
</html>
