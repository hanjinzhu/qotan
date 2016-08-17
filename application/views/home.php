<?php
$this->load->view('common/header');
?>
<div class="container" style="margin-top:80px;">

    <div class="input-prepend">
        <span class="add-on"><i class="fa fa-link"></i></span>
        <input  type="text" placeholder="http://" style="width:82%" class="submit_url_input">
        <button type="submit" class="btn btn-success pull-right green-btn submit_url_button">提交网址收录</button>
    </div>

    <div class="item">
        <div class="item_content">
            <h5>王尼玛打飞机</h5>
            <div>王尼玛打飞机打得飞起王尼玛打飞机打得飞起王尼玛打飞机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起</div>
            <ul class="clearfix inline item_raw_link">
                <li ><a class="original_url" href="" target="_blank" title="查看原始文档">wiki.jikexueyuan.com</a></li>
            </ul>
            <ul class="inline item_action">
                <li class="action_share" title="分享"><i class="fa fa-share"></i></li>
                <li class="action_mark" title="移动"><i class="fa fa-files-o"></i></li>
                <li class="action_delete" title="删除"><i class="fa fa-trash"></i></li>
                <li class="action_favorite" title="添加到收藏夹"><i class="fa fa-star-o"></i></li>
            </ul>
        </div>
    </div>
    <div class="item">
        <div class="item_content">
            <h5>王尼玛打飞机</h5>
            <div>王尼玛打飞机打得飞起王尼玛打飞机打得飞起王尼玛打飞机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起</div>
            <ul class="clearfix inline item_raw_link">
                <li ><a class="original_url" href="" target="_blank" title="查看原始文档">wiki.jikexueyuan.com</a></li>
            </ul>
            <ul class="inline item_action">
                <li class="action_share" title="分享"><i class="fa fa-share"></i></li>
                <li class="action_mark" title="移动"><i class="fa fa-files-o"></i></li>
                <li class="action_delete" title="删除"><i class="fa fa-trash"></i></li>
                <li class="action_favorite" title="添加到收藏夹"><i class="fa fa-star-o"></i></li>
            </ul>
        </div>
    </div>
    <div class="item">
        <div class="item_content">
            <h5>王尼玛打飞机</h5>
            <div>王尼玛打飞机打得飞起王尼玛打飞机打得飞起王尼玛打飞机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起</div>
            <ul class="clearfix inline item_raw_link">
                <li ><a class="original_url" href="" target="_blank" title="查看原始文档">wiki.jikexueyuan.com</a></li>
            </ul>
            <ul class="inline item_action">
                <li class="action_share" title="分享"><i class="fa fa-share"></i></li>
                <li class="action_mark" title="移动"><i class="fa fa-files-o"></i></li>
                <li class="action_delete" title="删除"><i class="fa fa-trash"></i></li>
                <li class="action_favorite" title="添加到收藏夹"><i class="fa fa-star-o"></i></li>
            </ul>
        </div>
    </div>
    <div class="item">
        <div class="item_content">
            <h5>王尼玛打飞机</h5>
            <div>王尼玛打飞机打得飞起王尼玛打飞机打得飞起王尼玛打飞机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起</div>
            <ul class="clearfix inline item_raw_link">
                <li ><a class="original_url" href="" target="_blank" title="查看原始文档">wiki.jikexueyuan.com</a></li>
            </ul>
            <ul class="inline item_action">
                <li class="action_share" title="分享"><i class="fa fa-share"></i></li>
                <li class="action_mark" title="移动"><i class="fa fa-files-o"></i></li>
                <li class="action_delete" title="删除"><i class="fa fa-trash"></i></li>
                <li class="action_favorite" title="添加到收藏夹"><i class="fa fa-star-o"></i></li>
            </ul>
        </div>
    </div>
    <div class="item">
        <div class="item_content">
            <h5>王尼玛打飞机</h5>
            <div>王尼玛打飞机打得飞起王尼玛打飞机打得飞起王尼玛打飞机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起机打得飞起</div>
            <ul class="clearfix inline item_raw_link">
                <li ><a class="original_url" href="" target="_blank" title="查看原始文档">wiki.jikexueyuan.com</a></li>
            </ul>
            <ul class="inline item_action">
                <li class="action_share" title="分享"><i class="fa fa-share"></i></li>
                <li class="action_mark" title="移动"><i class="fa fa-files-o"></i></li>
                <li class="action_delete" title="删除"><i class="fa fa-trash"></i></li>
                <li class="action_favo rite" title="添加到收藏夹"><i class="fa fa-star-o"></i></li>
            </ul>
        </div>
    </div>
</div>
<?php
$this->load->view('common/footer');
?>

<script>
$(document).ready(function(){
    $(".submit_url_button").click(function(){
        var url = $(".submit_url_input").val();
        if(url){
            $.post("/collect/collecturl", {url:url},function(data){
                if(data['code'] == 0){
                    alert("success");
                }else{
                    alert("fail");
                }
            },"json");
        }
    });
});
</script>