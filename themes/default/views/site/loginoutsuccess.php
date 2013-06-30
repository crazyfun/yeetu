<?php echo $ucsynlogout;?>
<div class="successBox">
          <span>您已经成功登出易途旅游网。</span>
          <p><strong class="px14">2秒后将自动转向易途旅游网主页。如果未自动跳转请点击<a href="<?php echo $this->createUrl('site/index'); ?>" >此处</a>进行跳转。</strong></p>
 </div>
        
        
<script type="text/javascript">
    window.setTimeout("toHome()",2000);
//-->
</script>