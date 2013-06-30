<?php echo $ucsynlogin;?>
<div class="successBox">
          <span>您已经成功登入到易途旅游网。</span>
          <p><strong class="px14">2秒后将自动转向前访问页。如果未自动跳转请点击<a href="<?php echo $redirect_url;?>" >此处</a>进行跳转。</strong></p>
 </div>
        
        
<script type="text/javascript">
	var redirect_url="<?= $redirect_url ?>";
   window.setTimeout(function(){window.location.href=redirect_url;},2000);
//-->
</script>