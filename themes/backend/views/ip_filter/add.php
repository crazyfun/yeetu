<div id="page_content">
	<div class="show_right_content">
		<div class="edit_content">
		<?php
		$form=$this->beginWidget('CActiveForm',
		array(
			'id' => 'ad_form',
			'enableAjaxValidation' => false,
		)
		);
		?>
			<div class="operate_result">
			<?php $this->widget("FlashInfo");?>
			</div>
			<div class="jwy_add"><?php if($model->id) echo '编辑限制IP:'.$model->id; else echo "添加限制IP"; ?></div>
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('ip_address'); ?></div>
				<div class="input_long_content">
			   <?php echo $form->textField($model,"ip_address");?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'ip_address');?>
				</div>
			</div>

			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('status');?></div>
				<div class="input_long_content">
				<?php echo $form->dropDownList($model,"status",CV::$IP_STATUS,array()); ?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'status');?>
				</div>
			</div>

			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('expire_time');?></div>
				<div class="search_item"><?php echo CHtml::textField("expire_time",$model->get_format_expire_time($model->expire_time),array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd H:mm:s",isShowWeek:true,startDate:"<?php echo $expire_time;?>"});'));?></div><span class="search_item" style="color:red;">提示：时间为空时表示“永不过期”</span>
				<div class="input_error"><?php echo $form->error($model,'expire_time');?></div>
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
					<?php echo CHtml::link("新增",array("{$this->id}/add"));?>
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
</div>
<!-- /#page_content -->
