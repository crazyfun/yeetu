<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href='<?php echo $this->createUrl("hotels/room",array('hotel_id'=>$model->hotel_id));?>'>返回到酒店房型管理</a></span></div></div>
    	
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'insertroom-form',
          'action'=>'',
	        'enableAjaxValidation'=>false,
	        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        )); ?>
        
    		<?php echo $form->hiddenField($model,"id");?>
    		<?php echo $form->hiddenField($model,"hotel_id");?>
    		<div class="operate_result"><?php $this->widget("FlashInfo");?></div>
        <div class="jwy_add"><?php if($model->id) echo "房型修改"; else echo "房型添加"; ?></div>
    		<div class="input_line"><div class="input_name">房型</div><div class="input_long_content"><?php $room_style=new RoomStyle();$room_style_select=$room_style->get_room_style_select(); echo $form->dropDownList($model,"room_name",$room_style_select,array()) ?></div><div class="input_error"><?php echo $form->error($model,'room_name'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">床型</div><div class="input_long_content"><?php echo $form->dropDownList($model,"room_bed",CV::$ROOM_BED,array()) ?></div><div class="input_error"><?php echo $form->error($model,'room_bed'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">居住人数</div><div class="input_long_content"><?php echo $form->dropDownList($model,"room_people",CV::$ROOM_PEOPLE,array()) ?></div><div class="input_error"><?php echo $form->error($model,'room_people'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">早餐</div><div class="input_long_content"><?php echo $form->dropDownList($model,"room_dinning",CV::$ROOM_DINNING,array()) ?></div><div class="input_error"><?php echo $form->error($model,'room_dinning'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">挂牌价</div><div class="input_long_content"><?php echo $form->textField($model,"room_price");?></div><div class="input_error"><?php echo $form->error($model,'room_price'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">易途价</div><div class="input_long_content"><?php echo $form->textField($model,"room_yprice");?></div><div class="input_error"><?php echo $form->error($model,'room_yprice'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">宽带</div><div class="input_long_content"><?php echo $form->dropDownList($model,"room_broadband",CV::$ROOM_BROADBAND,array()) ?></div><div class="input_error"><?php echo $form->error($model,'room_broadband'); ?></div><div class="clear_both"></div></div>

    		<div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"提交"));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("name"=>"reset","id"=>"reset","value"=>"重置"));?></div><div class="add_more"><?php echo CHtml::link("新增",array("hotels/addroom",'hotel_id'=>$model->hotel_id));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


