<div class="index_top">
	<div class="index_top_con">  
        <div>您好<?php if(!Yii::app()->user->isGuest){ echo "<a href='".$this->createUrl("user/index")."'>".Yii::app()->user->name."</a>";}else{echo "游客";}?>，欢迎来到易途旅行社！<?php if(Yii::app()->user->isGuest){ ?><a href="<?php echo $this->createUrl("site/login");?>" class="pl_login">请登录</a><input type="button" value="" class="reg_bt" onclick="javascript:window.location.href='<?php echo $this->createUrl("register/index"); ?>';"><?php } ?></div>
        <div class="right_links"><a href="javascript:addCookie('<?php echo Yii::app()->homeUrl;?>','易途旅游网');">收藏本站</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:setHomepage('<?php echo Yii::app()->homeUrl;?>');">设为主页</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $this->createUrl("help/index");?>">在线帮助</a><?php if(!Yii::app()->user->isGuest){ echo "&nbsp;&nbsp;|&nbsp;&nbsp;".CHtml::link("个人主页",array("user/index"),array());} ?><?php if(!Yii::app()->user->isGuest){ echo "&nbsp;&nbsp;|&nbsp;&nbsp;".CHtml::link("退出",array("site/logout"),array());} ?></div>
	</div>
</div><!--index_top end-->
<div class="content"> 
 <div class="logo_row">
        <div class="logo_con"><a href="<?php echo $this->createUrl("site/index");?>"><img src="/css/images/logo.jpg"></a></div>
        <div class="tel_con">
            <div></div>
        </div>
        <div class="start_city">
        	
        	  <div class="choose_district_off change_city" id="choose_select"><?php $sregion_session=Yii::app()->session->get('sregion_datas'); echo $sregion_session['name'];?></div><div class="choose_district_content" id="choose_content">
        		 <?php  
        		   
                $this->widget('Sregion',array( 
               	)); 
       
             ?>
        	</div>
        	
        </div>
        <div class="put_txt">
          <div>
          <?php echo CHtml::beginForm(Yii::app()->getController()->createUrl("search/index"),"GET",array("id"=>'headersearchform'));?>
         <input id="search_keywords" type="text" onfocus="var search_val=this.value;if(search_val=='请输入搜索内容'){this.value='';}" onblur="var search_val=this.value;if(!search_val){this.value='请输入搜索内容';}" id="search_trave_name" name="trave_name" value="请输入搜索内容"  class="txt"/>
         <input type="button" class="bt_sch" onclick="var search_val=document.getElementById('search_keywords').value;if(search_val=='请输入搜索内容'){document.getElementById('search_keywords').value=''}submit_form('headersearchform');" />
       <?php echo CHtml::endForm();?>	
      </div>
        </div>
    </div><!--logo_row-->


   
    <div class="nav">
    		<?php
		   if($this->beginCache(md5("mainmenu"), array('duration'=>"1"))){
                $this->widget('Mainmenu',array( 
                  'menu'=>array(
                   'big' => array(
                   		array('label'=>'首页','tag'=>'home','url'=>array('site/index'),'htmloptions'=>array('class'=>'bigmenu'),'isVisible'=>true,'subitem'=>array()),
                  		array('label'=>'周边旅游','tag'=>'p_travel','url'=>array('travel/peripheral'),'htmloptions'=>array('class'=>'bigmenu'),'isVisible'=>true,'subitem'=>array()),
                  		array('label'=>'国内旅游','tag'=>'d_travel','url'=>array('travel/domestic'),'htmloptions'=>array('class'=>'bigmenu'),'isVisible'=>true,'subitem'=>array()),
                   		array('label'=>'出境旅游','tag'=>'n_travel','url'=>array('travel/nation'),'htmloptions'=>array('class'=>'bigmenu'),'isVisible'=>true,'subitem'=>array()),
                   		array('label'=>'自助游','tag'=>'s_travel','url'=>array('travel/free'),'htmloptions'=>array('class'=>'bigmenu'),'isVisible'=>true,'subitem'=>array()),
                   		array('label'=>'公司旅游','tag'=>'g_travel','url'=>array('travel/group'),'htmloptions'=>array('class'=>'bigmenu'),'isVisible'=>true,'subitem'=>array()),
                   		array('label'=>'特价旅游','tag'=>'bargain','url'=>array('travel/bargain'),'htmloptions'=>array('class'=>'bigmenu'),'isVisible'=>true,'subitem'=>array()),
                   ),
                   'small' => array(
                      array('label'=>'资讯','tag'=>'traveinfor','url'=>array('traveinfor/index'),'htmloptions'=>array('class'=>'smallmenu'),'isVisible'=>true,'subitem'=>array()),
                      array('label'=>'问答','tag'=>'ask','url'=>array('qa/index'),'htmloptions'=>array('class'=>'smallmenu'),'isVisible'=>true,'subitem'=>array()),
                   		array('label'=>'搜索','tag'=>'bbs','url'=>array('search/index'),'htmloptions'=>array('class'=>'smallmenu'),'isVisible'=>true,'subitem'=>array()),

                   )
                  )
                )); 
         $this->endCache(); 
        } 

     ?>

    </div><!--nav end-->
    
 <div class="map_con">
        <div>
        	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
								'links'=>$this->breadcrumbs,
							)); ?>

	      
	     </div>
       <div class="pro_right"><a href="<?php echo $this->createUrl("register/index",array()); ?>" rel="nofollow">注册易途旅游网会员即得百元现金抵用券！</a></div>
  </div>
</div>
<script language="javascript">
	jQuery(function(){
		jQuery(".nav>.nav_M1>span:not(.span_line)").hover(function(){
			 jQuery(this).addClass("menu_select_hover");
		},
		function(){
			jQuery(this).removeClass("menu_select_hover");
		});
		
	});
</script>


