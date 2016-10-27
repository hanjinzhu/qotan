<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title?></title>
    <link href="/favicon.ico" rel="icon" type="image/x-icon" />
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
        
        <div class="container" style="margin-top:64px;">
            <div class="row">
                <div class="span8">
                    <div class="white_pannel main_pannel">
                    <div style="position:absolute;background:url('/static/images/web/pannel_cover.png') left top repeat-x; width:580px;height:60px;top: 504px;"></div>
                        


					<?php foreach($collect as $v):?>
			        <?php static $i =0;?>
			        <div class="media <?php if($i==0):?>no_border_top<?php endif;?>">
			          <div class="media-body">
			            <h4 class="media-heading"><a href=""><?php echo $v['title']?></a></h4>
			    
			            <div style="line-height: 1.7;"><a href="" style="color:#333;font-weight:bold;font-size:13px;"><?php echo $writeUser[$dataToUser[$v['id']]]['nick']?></a> <span style="color:#999;font-size:13px;margin-left:10px;"><?php echo $writeUser[$dataToUser[$v['id']]]['intro']?></span></div>
			            <div class="explore_summary"><?php echo $v['summary']?> <a href="" style="font-size:12px;margin-left:4px;">查看全文</a></div>
			          </div>
			        </div>
			        <?php $i++;?>
			        <?php endforeach;?>

<?php foreach($collect as $v):?>
			        <?php static $i =0;?>
			        <div class="media <?php if($i==0):?>no_border_top<?php endif;?>">
			          <div class="media-body">
			            <h4 class="media-heading"><a href=""><?php echo $v['title']?></a></h4>
			    
			            <div style="line-height: 1.7;"><a href="" style="color:#333;font-weight:bold;font-size:13px;"><?php echo $writeUser[$dataToUser[$v['id']]]['nick']?></a> <span style="color:#999;font-size:13px;margin-left:10px;"><?php echo $writeUser[$dataToUser[$v['id']]]['intro']?></span></div>
			            <div class="explore_summary"><?php echo $v['summary']?> <a href="" style="font-size:12px;margin-left:4px;">查看全文</a></div>
			          </div>
			        </div>
			        <?php $i++;?>
			        <?php endforeach;?>




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
                        	<div class="login_error">
                        		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <span class="login_error_info"></span>
                        	</div>
                            <button type="submit" class="pull-right green-btn submit_login_button login_btn">登&nbsp;录</button>
                            <div class="clearfix"></div>
                            <div class="other_login_type">
                                <span>其他登陆方式：</span>
                                <a href="" title="新浪微博"><i class="fa fa-weibo" style="font-size:16px;"></i> 新浪微博</a>
                                <a href="" title="腾讯QQ"><i class="fa fa-qq" ></i> 腾讯QQ</a>
                            </div>
                            <div class="app-btn-wrap">
                                <button type="submit" class="pull-left pink-btn app-btn">
                                    <i class="fa fa-apple" aria-hidden="true" style="font-size:18px;"></i> 苹果版下载
                                </button>
                                <button type="submit" class="pull-right pink-btn app-btn">
                                    <i class="fa fa-android" aria-hidden="true" style="font-size:18px;"></i> 安卓版下载
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="login-form-section login-form-links">
                        <div class="textbox-wrap">
                            <h4>我还没有账号?</h4>
                            <a href="/user/register">点击此处链接</a>
                            <span>去注册账号</span>
                        </div>
                    </div>
                    <div class="login-form-section login-form-links">
                        <div class="textbox-wrap">
                            <h4>我忘记了密码?</h4>
                            <a href="/user/forget_password">点击此处链接</a>
                            <span>去找回密码</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
            	<div class="pull-left"><a href="/">&copy; 2016 离线阅读 lixianyuedu.com</a></div>
            	<div class="pull-right">
            		<span class="dot">·</span>
            		<a href="/contact">联系我们</a>
            		<span class="dot">·</span>
            		<a href="/contact">关于离线阅读</a>
            		<span class="dot">·</span>
            		<a href="http://www.miibeian.gov.cn/">晋ICP备16005102号</a>
            	</div>
                <div class="clearfix"></div>
            </div>

        </div>
  </body>
</html>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".login_btn").unbind("click").click(function(){
            $.post("/user/dologin", {email:$(".email").val(),password:$(".password").val()},function(data){
                if(data['code'] == 0){
                    window.location.href="/home";
                }else{
                	$(".login_error_info").text(data['msg']);
                    $(".login_error").show();
                }
            },"json");
        });
    });
</script>