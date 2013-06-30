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
			<div class="jwy_add"><?php if($model->id) echo '编辑热景:'.$model->name; else echo "添加新热景"; ?></div>
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
				<div class="input_name"><?php echo $model->getAttributeLabel('type'); ?></div>
				<div class="input_long_content">
			   <?php echo $form->dropDownList($model,"type",CV::$HOT_OPTIONS);?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'type');?>
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
