 <div class="wj_mainl_11">
      	<div class="wj_vcon">
        	<h2 class="wj_vip">会员中心</h2>
			<div class="wjimgcon"><span>
<?php echo CHtml::link(CHtml::image($this->head_img,'',array('id'=>'user_head_center')),array('user/index'),array('rel'=>"nofollow"));?>
</span><span>
<?php echo CHtml::link($this->user_login,array('user/index'),array('rel'=>"nofollow"));?>

</span></div>
        </div>
      	<?php 
      	
      	if($this->beginCache("usermenu", array('duration'=>"1"))){
      			$this->widget('Usermenu',array( 
                  'menu'=>array(
                   		array('label'=>'交易管理','user_tag'=>'','url'=>array(''),'htmloptions'=>array(),'isVisible'=>false,
                   		   'subitem'=>array(
                   		      array('label'=>'我的订单','user_tag'=>'order','url'=>array('user/order'),'htmloptions'=>array(),'isVisible'=>false,'subitem'=>array()),
                   		      array('label'=>'抵用券','user_tag'=>'coupon','url'=>array('user/coupon'),'htmloptions'=>array(),'isVisible'=>false,'subitem'=>array()), 
                   		      array('label'=>'用户积分','user_tag'=>'credit','url'=>array('user/credit'),'htmloptions'=>array(),'isVisible'=>false,'subitem'=>array()),    
                   		    )
                   		),
                  		array('label'=>'个人信息','user_tag'=>'','url'=>array(''),'htmloptions'=>array(),'isVisible'=>false,
                  		   'subitem'=>array(
                  		      //array('label'=>'我的站内信','user_tag'=>'message','url'=>array('user/message'),'htmloptions'=>array(),'isVisible'=>false,'subitem'=>array()),
                   		      array('label'=>'修改头像','user_tag'=>'head','url'=>array('user/head'),'htmloptions'=>array(),'isVisible'=>false,'subitem'=>array()),
                   		      array('label'=>'个人资料','user_tag'=>'information','url'=>array('user/profile'),'htmloptions'=>array(),'isVisible'=>false,'subitem'=>array()),
                   		      array('label'=>'修改密码','user_tag'=>'password','url'=>array('user/password'),'htmloptions'=>array(),'isVisible'=>false,'subitem'=>array()),

                   		    )
                  		),
                  		/*
                  		array('label'=>'会员服务','user_tag'=>'','url'=>array(''),'htmloptions'=>array(),'isVisible'=>false,
                  		   'subitem'=>array(
                   		      array('label'=>'邮件订阅','user_tag'=>'email','url'=>array('user/email'),'htmloptions'=>array(),'isVisible'=>false,'subitem'=>array()),
                   		    )
                  		),	
                  		*/
                  		array('label'=>'其他信息','user_tag'=>'','url'=>array(''),'htmloptions'=>array(),'isVisible'=>false,
                  		   'subitem'=>array(
                  		      array('label'=>'我的点评','user_tag'=>'reviews','url'=>array('user/reviews'),'htmloptions'=>array(),'isVisible'=>false,'subitem'=>array()),
                  		      array('label'=>'浏览历史记录','user_tag'=>'history','url'=>array('user/history'),'htmloptions'=>array(),'isVisible'=>false,'subitem'=>array()),
                   		      array('label'=>'配送地址管理','user_tag'=>'distribution','url'=>array('user/distribution'),'htmloptions'=>array(),'isVisible'=>false,'subitem'=>array()),
                   		      array('label'=>'游客信息管理','user_tag'=>'visitors','url'=>array('user/visitors'),'htmloptions'=>array(),'isVisible'=>false,'subitem'=>array()),
                   		    )
                  		),
                  )
                )); 
                $this->endCache(); 
          } 
         ?>   

      </div><!--wj_mainl end-->
