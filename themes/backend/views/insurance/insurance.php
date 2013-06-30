<div id="page_content">
	<div class="show_right_content">
		<div class="edit_content">
		<?php
		$form=$this->beginWidget('CActiveForm',
		array(
			'id' => 'add_help_form',
			'action' => $this->createUrl("{$this->action->id}"),
			'enableAjaxValidation' => false,
		)
		);
		echo $form->hiddenField($model,'id');
		?>
			<div class="operate_result">
			<?php $this->widget("FlashInfo");?>
			</div>
			<div class="jwy_add"><?php if($model->id) echo '保险编辑'; else echo "保险添加"; ?></div>
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('insurance_name'); ?></div>
				<div class="input_long_content">
				<?php echo $form->textField($model, 'insurance_name');?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'insurance_name');?>
				</div>
			</div>
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('insurance_period'); ?></div>
				<div class="input_long_content">
				<?php echo $form->textField($model, 'insurance_period');?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'insurance_period');?>
				</div>
			</div>
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('insurance_pice'); ?></div>
				<div class="input_long_content">
				<?php echo $form->textField($model, 'insurance_pice');?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'insurance_pice');?>
				</div>
			</div>
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('insurance_explain'); ?></div>
				<div class="input_long_content">
				<?php echo $form->textarea($model, 'insurance_explain');?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'insurance_explain');?>
				</div>
			</div>
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('insurance_describe'); ?></div>
				<div class="input_long_content">
				<?php
				$this->widget('application.extensions.fckeditor.FCKEditorWidget',
				array(
						"model"=>$model,                # Data-Model
						"attribute"=>'insurance_describe',         # Attribute in the Data-Model
						"height"=>'400px',
						"width"=>'100%',
						"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
						"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
						"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
				));
				?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'insurance_describe');?>
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
