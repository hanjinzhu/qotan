<?php
$this->load->view('common/header');
?>
<div class="container" style="margin-top:70px;">
    <div style="padding:20px;background-color:#FFF;">
        <img src="xxx.png" style="width:100px;height:100px;float:left;margin-right:20px;" alt="<?php echo $userInfo['nick'];?>">
        <div style="float:left;">
            <p style="font-size:18px;font-weight:bold;"><?php echo $userInfo['nick'];?></p>
            <p title="快给自己添加个人介绍吧~~">
                快给自己添加个人介绍吧~~
                <a href="javascript:void(0);"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </p>
            <p>收录文章：3篇 <span style="margin:0px 20px;color:#eee">|</span> 喜欢文章：13篇</p>
            <p></p>
        </div>
        <ul style="float: right;line-height: 30px;margin-top: 15px; margin-left: 15px;list-style: none;">
            <li style="    float: left;    line-height: 30px;
    margin-right: 20px;
    font-size: 14px;
    text-align: center"><a title="他的关注" href="http://www.haodou.com/cook-28554/follow/follows/"><span style="color: #6a9700;
    font-family: Constantia,Georgia;
    font-size: 20px;">71</span><br>关注</a></li>
            <li style="    float: left;    line-height: 30px;
    margin-right: 20px;
    font-size: 14px;
    text-align: center">|</li>
            <li style="    float: left;    line-height: 30px;
    margin-right: 20px;
    font-size: 14px;
    text-align: center"><a title="他的粉丝" href="http://www.haodou.com/cook-28554/follow/fans/"><span style="color: #6a9700;
    font-family: Constantia,Georgia;
    font-size: 20px;">157</span><br>粉丝</a></li>
        </ul>
        <div class="clearfix"></div>
    </div>

</div>
<?php
$this->load->view('common/footer');
?>

<script>
$(document).ready(function(){
    
});
</script>