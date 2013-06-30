<div class="wj_mainL"><!--内容左边部分-->
	<div class="travel_infor_search">
	  <?php echo CHtml::beginForm(Yii::app()->getController()->createUrl("traveinfor/index"),"POST",array("id"=>'searchform'));?>
		  <span class="tf_search_title">资讯标题/资讯内容:</span><?php echo CHtml::textField("information_search",$information_search,array());?><span class="tf_search_theme">资讯主题</span><?php $infor_theme=new InforTheme();$select_value=$infor_theme->get_infor_theme_select(); echo CHtml::dropDownList("information_theme",$information_theme,$select_value,array());?>
		  
		  <input type="image" class="search_scbtn" src="/css/images/search_bn.gif">
		<?php echo CHtml::endForm();?>
	</div>
	
	<div class="travel_infor_list">
       <?php 
                
                  $this->widget('zii.widgets.CListView',array(
												'dataProvider'=>$info_dataProvider,
												'itemView'=>'info_item',
												'ajaxUpdate'=>true,
										));
        ?>
  </div>

     
   <?php
      	if($this->beginCache("Traveinfo_recommend", array('duration'=>"1"))){
              $this->widget('Traveinfo_recommend', array(  
                          
              )); 
             $this->endCache(); 
        }     
       ?>

	   <?php
      	if($this->beginCache("Traveinfo_new", array('duration'=>"1"))){
              $this->widget('Traveinfo_new', array(  
      
              )); 
             $this->endCache(); 
        }     
       ?>  
</div>
   
   
   

