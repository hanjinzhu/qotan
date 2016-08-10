<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登陆-离线网页阅读神器</title>
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/css/login.css" rel="stylesheet">
    <script type="text/javascript" src="http://www.ijquery.cn/js/jquery.placeholder.min.js"></script>

  </head>
  <body class="login_bg">
       <div class="login-form-section">
            <div class="return_link">
                <a href="/index"><i class="glyphicon glyphicon-arrow-left"></i>返回</a>
            </div>
            <form>
                <div class="section-title">
                    <h3>账户登陆</h3>
                </div>
                <div class="textbox-wrap">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
                        <input type="email"  class="form-control" placeholder="请输入电子邮箱">
                    </div>
                </div>
                <div class="textbox-wrap">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
                        <input type="password"  class="form-control " placeholder="请输入密码">
                    </div>
                </div>
                <div class="clearfix login-form-action">
                    <div class="pull-left remember_me">
                        <label class="checkbox-inline">
                          <input type="checkbox"  value="option3" checked="checked"> 记住我
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success pull-right  green-btn">登录 &nbsp; <i class="glyphicon glyphicon-chevron-right"></i></button>
                    <div class="clearfix"></div>
                    <div class="other_login_type">
                        <span>其他登陆方式：</span>
                        <a href="" title="新浪微博"><img src="/static/images/web/weibo.png" style="width:22px;"></a>
                        <a href="" title="腾讯QQ"><img src="/static/images/web/qq.png"></a>
                    </div>
                </div>
            </form> 
        </div>

        <div class="login-form-section login-form-links">
            <h4>我还没有账号?</h4>
            <a href="/user/register" class="blue">点击此处链接</a>
            <span>去注册账号</span>
        </div>
        <div class="login-form-section login-form-links">
            <h4>我忘记了密码?</h4>
            <a href="/user/forget_password" class="green">点击此处链接</a>
            <span>去找回密码</span>
        </div>
  </body>
</html>