<?php
$this->load->view('common/header');
?>

  <div class="container catelog_select" style="margin-top:80px;<?php if(!$myLikeCatelog):?>display:block;<?php endif;?>">
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
        <button class="red-btn explore-btn" type="button" style="margin:10px;">๑❛ᴗ❛๑ 提交选择</button>
      </div>
  </div>
<?php if($myLikeCatelog):?>
<div class="container" style="margin-top:80px;">
  <div class="row">
    <div class="span9">
    <?php if(empty($collect)):?>

    <?php else:?>
      <?php foreach($collect as $v):?>
        <div class="media">
    
          <div class="media-body">
            <h4 class="media-heading"><a href=""><?php echo $v['title']?></a></h4>
            <?php echo $v['summary']?>
          </div>
          <div class="media-body" style="padding-left:60px;margin-top:8px;">
            <span class="label label-success">Http</span>
            <span class="label label-success">计算机技术</span>
            <span class="label label-success">文本分析</span>
            <ul class="inline pull-right" style="display:inline;">
              <li class="action_favorite" title="收录到我的阅读"><a href=""><i class="fa fa-star-o"></i> 收录到我的阅读</a></li>
              <li class="action_share" title="分享"><a href=""><i class="fa fa-share"></i>分享</a></li>
            </ul>
          </div>
      </div>
      <?php endforeach;?>
    <?php endif;?>
      </div>
    <div class="span3">...</div>
  </div>
<?php endif;?>        
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
  });
</script>