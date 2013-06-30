<div id="page_content">
	<div class="show_right_content">
		<div class="edit_content">
		<?php
		$form=$this->beginWidget('CActiveForm',
		array(
			'id' => 'ad_form',
			'action' => "",
			'enableAjaxValidation' => false,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		)
		);
		echo $form->hiddenField($model,'id');
		?>
			<div class="operate_result">
			<?php $this->widget("FlashInfo");?>
			</div>
			<div class="jwy_add"><?php if($model->id) echo 'Flash广告编辑'; else echo "Flash广告添加"; ?></div>
			
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('ad_sregion_id'); ?></div>
				<div class="input_long_content">
			   <?php 
                $sregion_datas=Cfenzhan::model()->get_fenzhan_permissions();
		            echo $form->dropDownList($model,"ad_sregion_id",$sregion_datas,array());
		     ?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'ad_sregion_id');?>
				</div>
			</div>
			
			
			<div class="input_line">
				<div class="input_name">上传Flash广告图片</div>
				<div class="input_long_content">
				  <?php echo $form->FileField($model,'ad_src');?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'ad_src');?>
				</div>
			</div>
			<?php if($model->id){ ?><div class="input_line"><div class="input_name">&nbsp;&nbsp;</div><div class="input_content"><?php  echo CHtml::checkBox("select_image",1,array('checked'=>"checked")).$model->get_flash_image();?></div></div><?php } ?>
			
			<div class="input_line">
				<div class="input_name">广告连接</div>
				<div class="input_long_content">
			      <?php echo $form->textField($model,"ad_link",array());?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'ad_link');?>
				</div>
			</div>
			
			<div class="input_line">
				<div class="input_name">广告名称</div>
				<div class="input_long_content">
				   <?php echo $form->textField($model,'ad_name');?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'ad_name');?>
				</div>
			</div>
			
			
			
			<div class="input_line">
				<div class="input_name">广告排序</div>
				<div class="input_long_content">
				   <?php echo $form->textField($model,'ad_sort');?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'ad_sort');?>
				</div>
			</div>
			
			
			<div class="input_line hasbgbot">
				<div class="edit_input_button">
					<div class="input_submit">
					<?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"提交"));?>
					</div>
					<div class="input_cancel">
					<?php echo CHtml::resetButton("reset",array("name"=>"reset","id"=>"reset","value"=>"重置"));?>
					</div>
					<div class="add_more">
					<?php echo CHtml::link("新增",array("{$this->id}/flashadd"));?>
					</div>
					<div class="clear_both"></div>
				</div>
			</div>
			<?php
			$this->endWidget();
			?>
		</div>
		<!-- /.edit_content -->
	</div>
	<!-- /.show_right_content -->
	
	 <div id="float_big_image">
      <img id="show_big_image"/>
   </div>
</div>
<!-- /#page_content -->
