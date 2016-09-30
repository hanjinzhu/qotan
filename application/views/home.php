<?php
$this->load->view('common/header');
?>
<div class="container" style="margin-top:70px;">
    <div class="container" style="margin-bottom:20px;">
        <div class="input-prepend" >
            <span class="add-on"><i class="fa fa-link"></i></span>
            <input  type="text" placeholder="http://" class="submit_url_input" style="width:445px;">
            <button type="submit" class="pull-right green-btn submit_url_button">提交网址收录</button>
        </div>
    </div>

    <div id="item_box">
        
    </div>
</div>
<?php
$this->load->view('common/footer');
?>

<script>
$(document).ready(function(){
    var item_tpl =  '<div class="item">'+
                        '<div class="item_content">'+
                            '<a href="/collect/getcollectdetail?id={id}"><h5>{title}</h5></a>'+
                            '<div>{summary}</div>'+
                            '<ul class="clearfix inline item_raw_link">'+
                                '<li ><a class="original_url" href="{fetch_url}" target="_blank" title="查看原始文档">{base_url}</a></li>'+
                            '</ul>'+
                            '<ul class="inline item_action">'+
                                '<li class="action_share" title="分享"><i class="fa fa-share"></i></li>'+
                                '<li class="action_mark" title="移动"><i class="fa fa-files-o"></i></li>'+
                                '<li class="action_delete" title="删除"><i class="fa fa-trash"></i></li>'+
                                '<li class="action_favorite" title="添加到收藏夹"><i class="fa fa-star-o"></i></li>'+
                            '</ul>'+
                        '</div>'+
                    '</div>';
                                
    $.get("/collect/getmycollect", {},function(ret){
        var list = ret.data;
        temp_tpl = '';
        for (i in list){
            temp_tpl += item_tpl.replace(/\{\w+\}/g, function(m) {
                return list[i][m.substring(1, m.length-1)];
            });
        }
        $("#item_box").html(temp_tpl);    
    },"json");
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