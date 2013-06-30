<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("freetn/index");?>">返回到国际机+酒店</a></span><span><a href='<?php echo $this->createUrl("freetn/traveflight",array('trave_id'=>$model->trave_id));?>'>返回到国际机+酒店航班</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserttraveflight-form',
          'action'=>$this->createUrl("freetn/inserttraveflight",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
           <?php echo $form->hiddenField($model,"id");?>
           <?php echo $form->hiddenField($model,"trave_id");?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add"><?php if($model->id) echo "国内机+酒店航班修改"; else echo "国内机+酒店航班添加"; ?></div>
           
           <div class="input_line"><div class="input_name">出发地</div><div class="input_content"><?php echo $form->textField($model,"departure");?></div><div class="input_error"><?php echo $form->error($model,'departure'); ?></div><div class="input_name">目的地</div><div class="input_content"><?php echo $form->textField($model,"destinations");?></div><div class="input_error"><?php echo $form->error($model,'destinations'); ?></div><div class="clear_both"></div></div>
           
           <div class="input_line"><div class="input_name">去程航班</div><div class="input_content"><?php echo $form->textField($model,"go_flight");?></div><div class="input_error"><?php echo $form->error($model,'go_flight'); ?></div><div class="input_name">去程机型</div><div class="input_content"><?php echo $form->textField($model,"go_flight_type");?></div><div class="input_error"><?php echo $form->error($model,'go_flight_type'); ?></div><div class="input_name">去程航空公司</div><div class="input_content"><?php echo $form->textField($model,"go_flight_com");?></div><div class="input_error"><?php echo $form->error($model,'go_flight_com'); ?></div><div class="clear_both"></div></div>
      
           <div class="input_line"><div class="input_name">去程起飞机场</div><div class="input_content"><?php echo $form->textField($model,"go_flight_airport");?></div><div class="input_error"><?php echo $form->error($model,'go_flight_airport'); ?></div><div class="input_name">去程抵达机场</div><div class="input_content"><?php echo $form->textField($model,"go_flight_rairport");?></div><div class="input_error"><?php echo $form->error($model,'go_flight_rairport'); ?></div><div class="clear_both"></div></div>
                   
           <div class="input_line"><div class="input_name">去程起飞时间</div><div class="input_content"><?php echo CHtml::textField("go_flight_time",$model->go_flight_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"H:m:s",isShowWeek:true,startDate:"<?php echo $model->go_flight_time;?>",readOnly:true});'));?></div><div class="input_error"><?php echo $form->error($model,'go_flight_time'); ?></div><div class="input_name">去程降落时间</div><div class="input_content"><?php echo CHtml::textField("go_flight_rtime",$model->go_flight_rtime,array("onclick"=>'javascript:WdatePicker({dateFmt:"H:m:s",isShowWeek:true,startDate:"<?php echo $model->go_flight_rtime;?>",readOnly:true});'));?></div><div class="input_error"><?php echo $form->error($model,'go_flight_rtime'); ?></div><div class="clear_both"></div></div>

           <div class="input_line"><div class="input_name">去程转机航班</div><div class="input_content" id="add_gtransfer_flight">
           	<?php
           	 if(!empty($gtranfer_flight)){
           	  foreach((array)$gtranfer_flight as $key => $value){
           	    if($key==0){
           	     echo CHtml::textField("gtransfer_flight[]",$value,array('id'=>'gtransfer_flight_clone'));
           	    }else{
           	     echo "<p></p>";
           	     echo CHtml::textField("gtransfer_flight[]",$value,array('id'=>''));
           	    }
           	  }
           	}else{
           		echo CHtml::textField("gtransfer_flight[]",$value,array('id'=>'gtransfer_flight_clone'));
           	}
           	 ?>
           	</div><div><a href="javascript:add_gtransfer_flight();">增加去程转机航班</a></div><div class="input_error"><?php echo $form->error($model,'gtransfer_flight'); ?></div><div class="clear_both"></div></div>

           <div class="input_line"><div class="input_name">回程航班</div><div class="input_content"><?php echo $form->textField($model,"back_flight");?></div><div class="input_error"><?php echo $form->error($model,'back_flight'); ?></div><div class="input_name">回程机型</div><div class="input_content"><?php echo $form->textField($model,"back_flight_type");?></div><div class="input_error"><?php echo $form->error($model,'back_flight_type'); ?></div><div class="input_name">回程航空公司</div><div class="input_content"><?php echo $form->textField($model,"back_flight_com");?></div><div class="input_error"><?php echo $form->error($model,'back_flight_com'); ?></div><div class="clear_both"></div></div>

           <div class="input_line"><div class="input_name">回程起飞机场</div><div class="input_content"><?php echo $form->textField($model,"back_flight_airport");?></div><div class="input_error"><?php echo $form->error($model,'back_flight_airport'); ?></div><div class="input_name">回程抵达机场</div><div class="input_content"><?php echo $form->textField($model,"back_flight_rairport");?></div><div class="input_error"><?php echo $form->error($model,'back_flight_rairport'); ?></div><div class="clear_both"></div></div>
                   
           <div class="input_line"><div class="input_name">回程起飞时间</div><div class="input_content"><?php echo CHtml::textField("back_flight_time",$model->back_flight_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"H:m:s",isShowWeek:true,startDate:"<?php echo $model->back_flight_time;?>",readOnly:true});'));?></div><div class="input_error"><?php echo $form->error($model,'back_flight_time'); ?></div><div class="input_name">回程降落时间</div><div class="input_content"><?php echo CHtml::textField("back_flight_rtime",$model->back_flight_rtime,array("onclick"=>'javascript:WdatePicker({dateFmt:"H:m:s",isShowWeek:true,startDate:"<?php echo $model->back_flight_rtime;?>",readOnly:true});'));?></div><div class="input_error"><?php echo $form->error($model,'back_flight_rtime'); ?></div><div class="clear_both"></div></div>

           <div class="input_line"><div class="input_name">回程转机航班</div><div class="input_content" id="add_btransfer_flight">
           	
           	<?php
           	 if(!empty($btranfer_flight)){
           	  foreach((array)$btranfer_flight as $key => $value){
           	    if($key==0){
           	     echo CHtml::textField("btransfer_flight[]",$value,array('id'=>'btransfer_flight_clone'));
           	    }else{
           	     echo "<p></p>";
           	     echo CHtml::textField("btransfer_flight[]",$value,array('id'=>''));
           	    }
           	  }
           	}else{
           		echo CHtml::textField("btransfer_flight[]",$value,array('id'=>'btransfer_flight_clone'));
           	}
           	 ?>
           	</div><div><a href="javascript:add_btransfer_flight();">增加回程转机航班</a></div><div class="input_error"><?php echo $form->error($model,'btransfer_flight'); ?></div><div class="clear_both"></div></div>
           	        <div class="input_line"><div class="input_name">去程时间</div><div class="input_content"><?php echo CHtml::textField("start_date",$model->start_date,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-M-dd",isShowWeek:true,startDate:"<?php echo $model->start_date;?>",readOnly:true});'));?></div><div class="input_error"><?php echo $form->error($model,'start_date'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">回程时间</div><div class="input_content"><?php echo CHtml::textField("end_date",$model->end_date,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-M-dd",isShowWeek:true,startDate:"<?php echo $model->end_date;?>",readOnly:true});'));?></div><div class="input_error"><?php echo $form->error($model,'end_date'); ?></div><div class="clear_both"></div></div>
           		
           		
           		
           <div class="input_line"><div class="input_name">航班组价钱</div><div class="input_content"><?php echo $form->textField($model,"total_price");?></div><div class="input_error"><?php echo $form->error($model,'total_price'); ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">航班组描述</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'flight_desc',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          )); 
        ?></div><div class="input_error"><?php echo $form->error($model,'flight_desc'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("freetn/addtraveflight",'trave_id'=>$model->trave_id));?></div><div class="clear_both"></div></div></div>

    	<?php $this->endWidget(); ?>
    	</div>
    </div>
    <script language="javascript">
     //增加转班
     function add_btransfer_flight(){
	      	var transfer_flight=document.getElementById("btransfer_flight_clone");
					var transfer_flight_clone=transfer_flight.cloneNode(true);
					transfer_flight_clone.id="";
					var br_object=document.createElement("P");
					transfer_flight.parentNode.appendChild(br_object);
					transfer_flight.parentNode.appendChild(transfer_flight_clone);
     }
     
     
     
       //增加转班
     function add_gtransfer_flight(){
	      	var transfer_flight=document.getElementById("gtransfer_flight_clone");
					var transfer_flight_clone=transfer_flight.cloneNode(true);
					transfer_flight_clone.id="";
					var br_object=document.createElement("P");
					transfer_flight.parentNode.appendChild(br_object);
					transfer_flight.parentNode.appendChild(transfer_flight_clone);
     }
    	
    </script>


