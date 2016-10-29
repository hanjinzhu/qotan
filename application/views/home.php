<?php
$this->load->view('common/header');
?>
<div class="container" style="margin-top:70px;">
    <div class="container" style="margin-bottom:20px;">
        <div class="input-prepend" id="search-input">
            <span class="add-on"><i class="fa fa-link theme-color"></i></span>
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
    var page = 1;
    var item_tpl =  '<div class="item">'+
                        '<div class="item_content">'+
                            '<a href="/collect/getcollectdetail?id={id}"><h5>{title}</h5></a>'+
                            '<div style="text-indent: 2em;">{summary}</div>'+
                            '<ul class="clearfix inline item_raw_link">'+
                                '<li ><a class="original_url" href="{fetch_url}" target="_blank" title="查看原始文档">{base_url}</a></li>'+
                            '</ul>'+
                            '<ul class="inline item_action" style="display:none;">'+
                                '<li class="action_share" title="分享"><a href="" class="normal-color"><i class="fa fa-share"></i></a></li>'+
                                '<li class="action_delete" title="删除"><a href="" class="normal-color"><i class="fa fa-times"></i></a></li>'+
                            '</ul>'+
                        '</div>'+
                    '</div>';

    $.get("/collect/getmycollect", {page:page},function(ret){
        var list = ret.data;
        temp_tpl = '';
        for (i in list){
            temp_tpl += item_tpl.replace(/\{\w+\}/g, function(m) {
                return list[i][m.substring(1, m.length-1)];
            });
        }
        $("#item_box").html(temp_tpl);    
        $(".item").hover(
          function(){
            $(this).find(".item_action").show();
          },
          function(){
            $(this).find(".item_action").hide();
          }
        );
    },"json");
                             


    $(".item").hover(
      function(){
        $(this).find(".item_action").show();
      },
      function(){
        $(this).find(".item_action").hide();
      }
    );

    $(".submit_url_button").click(function(){
        var url = $(".submit_url_input").val();
        if(url){
            $.post("/collect/collecturl", {url:url},function(data){
                if(data['code'] == 0){
                    temp_tpl = '';
                    var append_data = data['data'];
                    console.log(append_data);
                    temp_tpl = item_tpl.replace(/\{\w+\}/g, function(m) {
                        return append_data[m.substring(1, m.length-1)];
                    });
                    $("#item_box").prepend(temp_tpl);
                }else{
                    alert("fail");
                }
            },"json");
        }
    });

});
</script>