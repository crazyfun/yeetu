<div id="page_content">
	<div class="show_right_content">
		<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("importp");?>">返回信息管理</a></span></div></div>
		<div class="edit_content">
		<?php
		$form=$this->beginWidget('CActiveForm',
		array(
			'id' => 'add_batch',
			'action' => '',
			'enableAjaxValidation' => false,
		)
		);
		echo $form->hiddenField($model,'id');
		?>
			<div class="operate_result">
			<?php $this->widget("FlashInfo");?>
			</div>
			<div class="jwy_add"><?php if($model->id) echo "修改信息"; else echo "添加信息"; ?></div>
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('name'); ?></div>
				<div class="input_content">
				  <?php echo $form->textField($model, 'name');?>
        </div>
				<div class="input_error">
				  <?php echo $form->error($model, 'name');?>
				</div>
			</div>
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('phone'); ?></div>
				<div class="input_content">
				  <?php echo $form->textField($model, 'phone');?>
        </div>
				<div class="input_error">
				  <?php echo $form->error($model, 'phone');?>
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
					  <?php
					     echo CHtml::link("新增",array("importpedit"));
					  ?>
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
