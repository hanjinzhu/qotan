<?php
$this->load->view('common/header');
?>
<div class="container" style="margin-top:70px;">
    <div class="white_pannel">
        <img src="xxx.png" class="ucenter_avatar" alt="<?php echo $userInfo['nick'];?>">
        <div class="pull-left left_ucenter_intro">
            <p class="ucenter_nick" ><?php echo $userInfo['nick'];?> <a href="" >编辑我的账号</a></p>
            <p title="快给自己添加个人介绍吧~~" class="self_intro">
                快给自己添加个人介绍吧~~
                <a href="javascript:void(0);"><i class="fa fa-pencil" aria-hidden="true" style="color:#999"></i></a>
            </p>
            <p>收录文章：3篇 <span class="ucenter_divider">|</span> 喜欢文章：13篇</p>
        </div>
        <ul class="ucenter_fans">
            <li>
                <a title="他的关注" href="http://www.haodou.com/cook-28554/follow/follows/"><span class="num">71</span><br>关注</a>
            </li>
            <li>|</li>
            <li>
                <a title="他的粉丝" href="http://www.haodou.com/cook-28554/follow/fans/"><span class="num">157</span><br>粉丝</a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="white_pannel" style="margin-top:20px">
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#dynamic" data-toggle="tab">我的动态</a></li>
            <li><a href="#like" data-toggle="tab">我喜欢的文章</a></li>
            <li><a href="#follow" data-toggle="tab">我的关注</a></li>
            <li><a href="#fans" data-toggle="tab">我的粉丝</a></li>            
        </ul>

        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="dynamic">
                <p>W3Cschoool菜鸟教程是一个提供最新的web技术站点，本站免费提供了建站相关的技术文档，帮助广大web技术爱好者快速入门并建立自己的网站。菜鸟先飞早入行——学的不仅是技术，更是梦想。</p>
            </div>
            <div class="tab-pane fade" id="like">
                <p>iOS 是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和 Apple
                    TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS 是苹果的移动版本。</p>
            </div>
            <div class="tab-pane fade" id="follow">
                <p>jMeter 是一款开源的测试软件。它是 100% 纯 Java 应用程序，用于负载和性能测试。</p>
            </div>
            <div class="tab-pane fade" id="fans">
                <p>Enterprise Java Beans（EJB）是一个创建高度可扩展性和强大企业级应用程序的开发架构，部署在兼容应用程序服务器（比如 JBOSS、Web Logic 等）的 J2EE 上。
                </p>
            </div>
        </div>
    </div>    
</div>
<?php
$this->load->view('common/footer');
?>

<script>
$(document).ready(function(){
    
});
</script>