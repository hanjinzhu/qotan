<?php
require_once 'class.textExtract.php';
//$iTextExtractor = new HtmlExtract( "https://cattail.me/tech/2016/06/06/git-commit-message-and-branching-model.html" );
$iTextExtractor = new htmlExtract( "http://toutiao.com/a6308953874795332097/" );
$text = $iTextExtractor->getPlainText();
echo $text;	
exit;
?>

































































<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <title>Hello APP</title>
    <link rel="stylesheet" type="text/css" href="./css/api.css" />
    <style type="text/css">
    html,body{
        height: 100%;
    }
    #wrap{
        height: 100%;
        display: -webkit-box;
        display: -webkit-flex;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-flex-flow: column;
               flex-flow: column;
    }
    #header{
        text-align: center; background-color: #81a9c3; color: #fff;
        width: 100%;
    }
    #header h1{
        font-size: 20px; height: 44px; line-height: 44px; margin: 0em; color: #fff;
    }
    #main{
        -webkit-box-flex: 1; 
        -webkit-flex: 1;
        flex: 1;
    }
    #footer{
        height: 30px; line-height: 30px;
        background-color: #81a9c3; 
        width: 100%;
        text-align: center;
    }
    #footer h5{
        color: white;
    }
    .con{font-size: 28px; text-align: center;}
    </style>
</head>
<body>
    <div id="wrap">
        <div id="header">
            <h1>APICloud</h1>
        </div>
        <div id="main">
                
        </div>
        <div id="footer">
            <h5>Copyright &copy;<span id="year"></span> </h5>
        </div>
    </div>
</body>
<script type="text/javascript" src="./script/api.js"></script>
<script type="text/javascript">
    apiready = function(){
		console.log("Hello APICloud");

        var header = $api.byId('header');
        //适配iOS 7+，Android 4.4+状态栏
        $api.fixStatusBar(header);

        var headerPos = $api.offset(header);
        var main = $api.byId('main');
        var mainPos = $api.offset(main);
        api.openFrame({
            name: 'main',
            url: 'html/main.html',
            bounces: true,
            rect: {
                x: 0,
                y: headerPos.h,
                w: 'auto',
                h: mainPos.h
            }
        });

        var year = $api.byId('year');
        year.innerHTML = new Date().getFullYear();

    };
</script>
</html>











<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>麒麟送菜</title>
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="x5-page-mode" content="app">

	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./css/default.css">
	<link rel="stylesheet" type="text/css" href="./css/app.css">
	<script type="text/javascript" src="./script/api.js"></script>
	<script type="text/javascript" src="./script/jquery.min.js"></script>
	<script type="text/javascript" src="./script/bootstrap.js"></script>
</head>

    <style type="text/css">
    #wrap{
        height: 100%;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-flex-flow: column;
    }
    </style>
</head>
<body>
    <div id="wrap" class="flex-con flex-wrap flex-vertical">
		<div id="main">
                
        </div>

	    <div class="btd c2 tc" style="margin-top: 0px;">
	        <ul class="bgf footnav flex-wrap flex-horizontal">
	            <li class="flex-con quick-itemli footon">
	            	<a href="home.html">
						<span class="homeimg"></span>
		                <div>首页</div>
	                </a>
	            </li>
	            <li class="flex-con quick-itemli">
		            <a href="class.html">
						<span class="classimg"></span>
		                <div>分类</div>
		            </a>
	            </li>
				<li class="w80 pr">
					<a href="cart.html" class="db br pa l0 footshop">
						<span class='pa footnum nowrap br'>总价:¥25.8</span>
					</a>
				</li>
	            <li class="flex-con quick-itemli">
		            <a href="order.html">
						<span class="orderimg"></span>
		                <div>订单</div>
		            </a>
	            </li>
	            <li class="flex-con quick-itemli">
		            <a href="my.html">
						<span class="myimg"></span>
		                <div>我的</div>
		            </a>
	            </li>
	        </ul>
	    </div>
    </div>
</body>

<script type="text/javascript">
    apiready = function(){
        var main = $api.byId('main');
        var mainPos = $api.offset(main);
        alert(mainPos.h);
        api.openFrame({
            name: 'home',
            url: 'html/main.html',
            bounces: true,
            rect: {
                x: 0,
                y: 0,
                w: 'auto',
                h: mainPos.h
            }
        });
    };
</script>
</html>

