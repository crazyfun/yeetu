<div id="page_content">
	<div class="show_right_content">
		<div class="edit_content">
		<?php
		$form=$this->beginWidget('CActiveForm',
		array(
			'id' => 'edit_question_form',
			'action' => $this->createUrl("qa/edit_answer", array('page' => $this->get_page())),
			'enableAjaxValidation' => false,
		)
		);
		echo $form->hiddenField($model,'id');
		?>
			<div class="operate_result">
			<?php $this->widget("FlashInfo");?>
			</div>
			<div class="jwy_add">编辑回答</div>
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('content'); ?></div>
				<div class="input_long_content">
				<?php echo $form->textArea($model, 'content');?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'content');?>
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
					<?php echo CHtml::link('返回该问题', $this->createUrl('qa/view', array('id'=>$model->question_id, 'page'=>$page)))?>
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
