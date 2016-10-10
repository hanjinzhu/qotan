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
       <div class="color-line" style="position:relative;top:-40px"></div>
        
        <div class="container" >
            <div class="row">
                <div class="span8">
                    <div class="white_pannel">
                        <img src="/static/images/web/sub_title.png" style="width:500px;">
                    </div>
                </div>
                <div class="span4">
                    <div class="login-form-section">
                        <div class="section-title">
                            <h3>账户登陆</h3>
                        </div>
                        <div class="textbox-wrap">
                            <div class="input-prepend">
                                <span class="add-on"><i class="fa fa-envelope"></i></span>
                                <input  type="text" class="email" placeholder="请输入电子邮箱" style="width: 215px;">
                            </div>
                        </div>
                        <div class="textbox-wrap">
                            <div class="input-prepend">
                                <span class="add-on"><i class="fa fa-key"></i></span>
                                <input  type="password" class="password" placeholder="请输入密码" style="width: 215px;">
                            </div>
                        </div>
                        <div class="clearfix login-form-action">
                            <button type="submit" class="pull-right btn btn-success my-btn login_btn">登录</button>
                            <div class="clearfix"></div>
                            <div class="other_login_type">
                                <span>其他登陆方式：</span>
                                <a href="" title="新浪微博"><img src="/static/images/web/weibo.png" style="width:22px;"></a>
                                <a href="" title="腾讯QQ"><img src="/static/images/web/qq.png"></a>
                            </div>
                        </div>
                    </div>

                    <div class="login-form-section login-form-links">
                        <div class="textbox-wrap">
                            <h4>我还没有账号?</h4>
                            <a href="/user/register" class="blue">点击此处链接</a>
                            <span>去注册账号</span>
                        </div>
                    </div>
                    <div class="login-form-section login-form-links">
                        <div class="textbox-wrap">
                            <h4>我忘记了密码?</h4>
                            <a href="/user/forget_password" class="green">点击此处链接</a>
                            <span>去找回密码</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </body>
</html>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".login_btn").click(function(){
            $.post("/user/dologin", {email:$(".email").val(),password:$(".password").val()},function(data){
                if(data['code'] == 0){
                    window.location.href="/home";
                }else{
                    //todo 错误提示
                }
            },"json");
        });
    });
</script>