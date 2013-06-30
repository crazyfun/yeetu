    <div class="search_line">
      <div class="user_line_t"><span>欢迎:<?php echo Yii::app()->user->getName();?> [<a href="<?php echo $this->controller->createUrl("site/logout");?>">退出</a>]</span></div>  
		  <div class="user_line_m">
		  	<div class="zjline">
				  <span> 最近浏览的线路</span>
		      <div class="helpcenter"><a href="#"><img src="/css/images/user_help.gif" /></a><a href="<?php echo $this->controller->createUrl("user/history"); ?>">[更多]</a></div>
			  </div>
			<ul>
				<?php 
				
				foreach($trave_history as $key => $value){ ?>
				   <li><a title="<?php echo $value->Trave->trave_name; ?>" href="<?php echo $this->controller->createUrl("travel/detail",array('id'=>$value->Trave->id,'n'=>$value->Trave->trave_title)); ?>"><?php echo Util::cs($value->Trave->trave_name,12);?></a></li>
				
			<?php } ?>
			</ul> 
			<div class="clear_float"></div>
		  <div class="apleft">
		  	<a rel="nofollow" class="user_btn" href="<?php echo Yii::app()->getController()->createUrl("user/order");?>"><img src="/css/images/user1_btn.gif" /></a>
		  	<a rel="nofollow" class="user_btn" href="<?php echo Yii::app()->getController()->createUrl("user/index");?>"><img src="/css/images/user2_btn.gif" /></a>
		  	<a rel="nofollow" class="user_btn" href="<?php echo Yii::app()->getController()->createUrl("user/profile");?>"><img src="/css/images/user3_btn.gif" /></a>
		  	<a class="user_btn" href="<?php echo Yii::app()->getController()->createUrl("qa/ask");?>"><img src="/css/images/user4_btn.gif" /></a>
			</a><div class="clear_float"></div>
		  </div>
		</div>
    <div class="user_line_b"></div>
  </div>
