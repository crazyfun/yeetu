<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("gcustomize/index");?>">返回到公司定制管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'insertgroup-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
        ?>
           <?php 
              echo $form->hiddenField($model,"id");
           ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add"><?php if($model->id) echo "公司定制修改"; else echo "公司定制添加"; ?></div>
           <div class="gc_group">
             <div class="gc_con">
        		 	   <div class="gc_tips_title">出游联系信息</div>
        		 	   <table class="gc_table">
        		 	   	  <tbody>
        		 	   	  	  <tr><td colspan="4"><div class="operate_result"><?php $this->widget("FlashInfo");?></div></td></tr>
        		 	   	  	  <tr>
        		 	   	  	  	<td class="gc_title"><b>*</b>联系人：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $form->textField($model,"contact_name",array('class'=>'gc_input_text'));?><span class="input_error"><?php echo $form->error($model,'contact_name'); ?></span></td>
        		 	   	  	  	<td class="gc_title"><b>*</b>手机号码：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $form->textField($model,"contact_phone",array('class'=>'gc_input_text'));?><span class="input_error"><?php echo $form->error($model,'contact_phone'); ?></span></td>
        		 	   	  	  </tr>
        		 	   	  	  
        		 	   	  	  <tr>
        		 	   	  	  	<td class="gc_title"><b>*</b>联系电话：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $form->textField($model,"contact_tel",array('class'=>'gc_input_text'));?><span class="input_error"><?php echo $form->error($model,'contact_tel'); ?></span></td>
        		 	   	  	  	<td class="gc_title">E-mail：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $form->textField($model,"contact_email",array('class'=>'gc_input_text'));?></td>
        		 	   	  	  </tr>
        		 	   	  	  
        		 	   	  	  
        		 	   	  	  <tr>
        		 	   	  	  	<td class="gc_title">回复时间：</td>
        		 	   	  	  	<td class="gc_input"><?php echo UserHmtl::get_radio_value("reply_time",CV::$GROUP_REPLY_TIME,$model->reply_time,"",false);?></td>
        		 	   	  	  	
        		 	   	  	  </tr>
        		 	   	  </tbody>
        		 	   	</table>
        		 </div>
          
          	<div class="gc_com">
        		 		<div class="gc_tips_title">出游信息</div>
        		 		<table class="gc_table" id="gc_com_message">
        		 		   <tr>
        		 	   	  	  <td class="gc_title">公司名称：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textField($model,"company_name",array('class'=>'gc_input_text'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">出发城市：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->dropDownList($model,"start_region",CV::$GROUP_START_REGION,array());?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">目的地：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textField($model,"end_region",array('class'=>'gc_input_text'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">出发日期：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textField($model,"start_time",array('class'=>'gc_input_text',"onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"",readOnly:true});'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">人数：</td>
        		 	   	  	  <td class="gc_cinput">成人数：<?php echo $form->textField($model,"adults",array('class'=>'gc_input_text'));?>儿童数：<?php echo $form->textField($model,"childs",array('class'=>'gc_input_text'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">天数：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textField($model,"travel_nums",array('class'=>'gc_input_text'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">出游预算：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textField($model,"travel_budget",array('class'=>'gc_input_text'));?>元/人</td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">交通工具：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo UserHmtl::get_radio_value("transport",CV::$GROUP_TRANSPORT,$model->transport,"",false);?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"transport_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">住宿标准：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo UserHmtl::get_radio_value("stay",CV::$GROUP_STAY,$model->stay,"",false);?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"stay_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">用餐标准：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo UserHmtl::get_radio_value("dinning",CV::$GROUP_DINNING,$model->dinning,"",false);?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"dinning_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">导游要求：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo UserHmtl::get_radio_value("guide",CV::$GROUP_GUIDE,$model->guide,"",false);?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"guide_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">购物安排：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo UserHmtl::get_radio_value("shopping",CV::$GROUP_SHOPPING,$model->shopping,"",false);?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"shopping_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">会议安排：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo UserHmtl::get_radio_value("meeting",CV::$GROUP_MEETING,$model->meeting,"",false);?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"meeting_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	     
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">其他需求：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"other_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>

        		 		</table>
        		 		
        		  </div>
        		  
        		</div>

    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("gcustomize/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>
    
    



