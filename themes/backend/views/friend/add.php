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
			<div class="jwy_add"><?php if($model->id) echo '编辑友情链接:'.$model->name; else echo "添加友情链接"; ?></div>
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('name'); ?></div>
				<div class="input_long_content">
			   <?php echo $form->textField($model,"name");?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'name');?>
				</div>
			</div>
			
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('link'); ?></div>
				<div class="input_long_content">
			   <?php echo $form->textField($model,"link");?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'link');?>
				</div>
			</div>
		
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('display'); ?></div>
				<div class="input_long_content">
			   <?php echo $form->textField($model,"display");?>
				<br/>
				<span style="color:#ccc">为0表示不显示，此值越小越靠前</span>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'display');?>
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
