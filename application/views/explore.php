<?php
$this->load->view('common/header');
?>
<div class="container" style="margin-top:60px;">
  <div class="row">
    <div class="span9">
      <div class="catelog_select" <?php if($myLikeCatelog):?>style="display:none;"<?php endif;?>>
          <p class="caltelog_select_sub">选取您感兴趣的分类，系统会根据您的选择做出文章推荐</p>
          <div> 
            <?php foreach($allCatelog as $v):?>
            <span class="label <?php if(in_array($v['id'], $likeCatelogId)):?>label-success<?php else:?>label-default<?php endif;?>" data-id="<?php echo $v['id']?>">
              <?php echo $v['name']?>
              <?php if(in_array($v['id'], $likeCatelogId)):?> <i class="fa fa-check" ></i><?php endif;?>
            </span>
            <?php endforeach;?>
          </div>
          <div class="clearfix">
            <button class="red-btn explore-btn" type="button" style="margin-left:10px;">๑❛ᴗ❛๑ 提交选择</button>
          </div>
      </div>
      
    <?php if(empty($collect)):?>
    <?php else:?>
      <?php foreach($collect as $v):?>
      <?php static $i =0;?>
        <div class="media <?php if($i==0):?>no_border_top<?php endif;?>">
          <div class="media-body">
            <h4 class="media-heading"><a href=""><?php echo $v['title']?></a></h4>
            <div class="explode_get">
              <div class="explode_get_btn">
                <i class="fa fa-star-o" style="font-size:14px;"></i> 收录
              </div>
              <div class="explode_get_btn">
                <i class="fa fa-heart-o"></i> 喜欢
              </div>
            </div>
            <div style="margin-left:54px;line-height: 1.7;"><a href="" style="color:#333;font-weight:bold;font-size:13px;"><?php echo $writeUser[$dataToUser[$v['id']]]['nick']?></a> <span style="color:#999;font-size:13px;margin-left:10px;"><?php echo $writeUser[$dataToUser[$v['id']]]['intro']?></span></div>
            <div style="margin-left:54px;" class="explore_summary"><?php echo $v['summary']?> <a href="" style="font-size:12px;margin-left:4px;">查看全文</a></div>
          </div>
          
      </div>
      <?php $i++;?>
      <?php endforeach;?>
    <?php endif;?>
      </div>
    <div class="span3">
      <?php if($myLikeCatelog):?><a href="javascript:void(0);" class="explore_btn"><i class="fa fa-gear"></i> 发现阅读偏好设置</a><?php endif;?>
    </div>
  </div>     
</div>

<?php
$this->load->view('common/footer');
?>

<script>
  $(document).ready(function(){
    $(".label-default.label").hover(
      function(){
        $(this).addClass("label-info");
        $(this).removeClass("label-default");
      },
      function(){
        $(this).removeClass("label-info");
        $(this).addClass("label-default");
      }
    );
    $(".label").click(function(){
      if($(this).hasClass("label-success")){
        $(this).find(".fa-check").remove();
        $(this).removeClass("label-success");
      }else{
        $(this).append(' <i class="fa fa-check" ></i>');
        $(this).addClass("label-success");
        $(this).removeClass("label-info");
        $(this).removeClass("label-default");
      }
    });
    $(".explore_btn").click(function(){
        $(".catelog_select").toggle();
    });
  });
</script>