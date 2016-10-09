<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>数据库查询</title>
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/static/css/font-awesome.min.css" rel="stylesheet">
    <link href="/static/css/style.css" rel="stylesheet">
    <link href="/static/css/home.css" rel="stylesheet">
  </head>
  <body>
  <div class="navbar  navbar-fixed-top bs-docs-nav">
        <div class="container">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="./index.html">离线阅读神器</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li <?php if($this->router->class == 'home'):?>class="active"<?php endif;?>>
                <a href="/home">主页</a>
              </li>
              <li <?php if($this->router->class == 'explore'):?>class="active"<?php endif;?>>
                <a href="/explore">发现</a>
              </li>
              <li <?php if($this->router->class == 'timeline'):?>class="active"<?php endif;?>>
                <a href="/timeline">动态</a>
              </li>
              <li <?php if($this->router->class == 'about'):?>class="active"<?php endif;?>>
                <a href="/about">关于离线阅读</a>
              </li>
            </ul>

            <ul class="nav pull-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $userInfo['nick']?> <b class="caret"></b></a>
                <ul class="dropdown-menu" style="border-radius:0px;">
                  <li><a href="/user/ucenter">个人中心</a></li>
                  <li><a href="#">更多收藏方式</a></li>
                  <li class="divider"></li>
                  <li><a href="#">退出</a></li>
                </ul>
              </li>
            </ul>
          </div>
      </div>
      <div class="color-line"></div>
</div>
    