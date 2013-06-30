<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("flights/traveflight");?>">返回到航班管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserttraveflight-form',
          'action'=>$this->createUrl("flights/inserttraveflight",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
           <?php echo $form->hiddenField($model,"id");?>
         
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add"><?php if($model->id) echo "航班修改"; else echo "航班添加"; ?></div>
           
           <div class="input_line"><div class="input_name">出发地</div><div class="input_content"><?php echo $form->textField($model,"departure");?></div><div class="input_error"><?php echo $form->error($model,'departure'); ?></div><div class="input_name">目的地</div><div class="input_content"><?php echo $form->textField($model,"destinations");?></div><div class="input_error"><?php echo $form->error($model,'destinations'); ?></div><div class="clear_both"></div></div>
           
           <div class="input_line"><div class="input_name">航班</div><div class="input_content"><?php echo $form->textField($model,"go_flight");?></div><div class="input_error"><?php echo $form->error($model,'go_flight'); ?></div><div class="input_name">机型</div><div class="input_content"><?php echo $form->textField($model,"go_flight_type");?></div><div class="input_error"><?php echo $form->error($model,'go_flight_type'); ?></div><div class="input_name">航空公司</div><div class="input_content"><?php echo $form->textField($model,"go_flight_com");?></div><div class="input_error"><?php echo $form->error($model,'go_flight_com'); ?></div><div class="clear_both"></div></div>
      
           <div class="input_line"><div class="input_name">起飞机场</div><div class="input_content"><?php echo $form->textField($model,"go_flight_airport");?></div><div class="input_error"><?php echo $form->error($model,'go_flight_airport'); ?></div><div class="input_name">抵达机场</div><div class="input_content"><?php echo $form->textField($model,"go_flight_rairport");?></div><div class="input_error"><?php echo $form->error($model,'go_flight_rairport'); ?></div><div class="clear_both"></div></div>
                   
           <div class="input_line"><div class="input_name">起飞时间</div><div class="input_content"><?php echo CHtml::textField("go_flight_time",$model->go_flight_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"H:m:s",isShowWeek:true,startDate:"<?php echo $model->go_flight_time;?>",readOnly:true});'));?></div><div class="input_error"><?php echo $form->error($model,'go_flight_time'); ?></div><div class="input_name">降落时间</div><div class="input_content"><?php echo CHtml::textField("go_flight_rtime",$model->go_flight_rtime,array("onclick"=>'javascript:WdatePicker({dateFmt:"H:m:s",isShowWeek:true,startDate:"<?php echo $model->go_flight_rtime;?>",readOnly:true});'));?></div><div class="input_error"><?php echo $form->error($model,'go_flight_rtime'); ?></div><div class="clear_both"></div></div>

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

    		<div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("flights/addtraveflight"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>
    <script language="javascript">
    	
    	/*
     //增加转班
     function add_btransfer_flight(){
	      	var transfer_flight=document.getElementById("btransfer_flight_clone");
					var transfer_flight_clone=transfer_flight.cloneNode(true);
					transfer_flight_clone.id="";
					var br_object=document.createElement("DIV");
					br_object.className="new_transfer_flight";
					var remove_object=document.createElement("DIV");
					remove_object.className="remove_flight";
					remove_object.innerHTML="<span onclick='javascript:remove_transfer_flight(this);'>移除</span>";
					br_object.appendChild(transfer_flight_clone);
					br_object.appendChild(remove_object);
					transfer_flight.parentNode.appendChild(br_object);
     }
     
     
     
       //增加转班
     function add_gtransfer_flight(){
	      	var transfer_flight=document.getElementById("gtransfer_flight_clone");
					var transfer_flight_clone=transfer_flight.cloneNode(true);
					transfer_flight_clone.id="";
					var br_object=document.createElement("DIV");
					br_object.className="new_transfer_flight";
					var remove_object=document.createElement("DIV");
					remove_object.className="remove_flight";
					remove_object.innerHTML="<span onclick='javascript:remove_transfer_flight(this);'>移除</span>";
					br_object.appendChild(transfer_flight_clone);
					br_object.appendChild(remove_object);
					transfer_flight.parentNode.appendChild(br_object);
     }
     
     function remove_transfer_flight(obj){
     	 var tparentNode=obj.parentNode.parentNode;
     	 var pparentNode=tparentNode.parentNode;
     	 pparentNode.removeChild(tparentNode);
     }
     
     */
    	
    </script>


