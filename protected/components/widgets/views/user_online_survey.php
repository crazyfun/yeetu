      <div class="classify">
            	<div class="classify_title">在线调查</div>
            	<div class="what_care">
            		<?php echo CHtml::beginForm(Yii::app()->getController()->createUrl("site/survey"),"POST",array("id"=>'onlinesurvey'));?>
                	<div class="what_title">预定路线时您最关注的是什么？</div>
                    <div class="care_options">
                    	  <?php $online_survey_datas=CV::$ONLINE_SURVEY_DATAS;
              foreach($online_survey_datas as $key => $value){
              	if($key==1){
              		$checked='checked="checked"';
              	}else{
              		$checked="";
              	}
            ?>
                 <div><input type="radio" name="survey_type" <?php echo $checked;?> value="<?php echo $key; ?>"><?php echo $value;?></div>
            <?php  	
              }
            ?>  
          
                	</div>
                    <div class="care_sub_bt"><img onclick="javascript:submit_survey_form('onlinesurvey');"src="/css/images/tj_bt.gif" /></div>
                    <?php echo CHtml::endForm();?>
                    
                            <div id="onlinesurvey_success" class="onlinesurvey_tips">
        	  <div class="onlinesurvey_title">
        	  	 <span><img src="/css/images/login_io.gif"></span><span>提交成功</span>
        	  </div>
        	  <div class="onlinesurvey_content">
        	  	 你的答案已经提交。
        	  </div>
        	
        </div>
        
        
        <div id="onlinesurvey_failed" class="onlinesurvey_tips">
        	 <div class="onlinesurvey_title">
        	  	 <span><img src="/css/images/wjclose.gif"></span><span>提交失败</span>
        	  </div>
        	  <div class="onlinesurvey_content">
        	  	你的答案已经提交过了,不需要重新提交。
        	  </div>
        	
        </div>
        
        
                </div>
                

</div>
            
            