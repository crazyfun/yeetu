<div id="page_content">
	<div class="show_right_content">
		<div class="edit_content">
		<?php
		$form=$this->beginWidget('CActiveForm',
		array(
			'id' => 'add_help_form',
			'action' => $this->createUrl("help/$action"),
			'enableAjaxValidation' => false,
		)
		);
		echo $form->hiddenField($model,'id');
		?>
			<div class="operate_result">
			<?php $this->widget("FlashInfo");?>
			</div>
			<div class="jwy_add"><?php if($model->id) echo '帮助编辑'; else echo "帮助添加"; ?></div>
			<div class="input_line">
				<div class="input_name">类别</div>
				<div class="input_long_content">
					<?php 
					$downListData = HelpType::model()->get_list();
					if (empty($downListData))
						echo '你还没有添加帮助类别';
					else 
						echo $form->dropDownList($model, 'type_id', $downListData);
					?>
				</div>
			</div>
			<div class="input_line">
				<div class="input_name">标题</div>
				<div class="input_long_content">
				<?php echo $form->textField($model, 'title');?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'title');?>
				</div>
			</div>
			<div class="input_line">
				<div class="input_name">内容</div>
				<div class="input_long_content">
		<?php
				$this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
						"model"=>$model,                # Data-Model
						"attribute"=>'content',         # Attribute in the Data-Model
						"height"=>'400px',
						"width"=>'100%',
						"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
						"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
						"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
				));
		?>
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
					<div class="add_more">
					<?php echo CHtml::link("新增",array("help/help_add"));?>
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
