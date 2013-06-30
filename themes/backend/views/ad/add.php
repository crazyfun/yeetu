<div id="page_content">
	<div class="show_right_content">
		<div class="edit_content">
		<?php
		$form=$this->beginWidget('CActiveForm',
		array(
			'id' => 'ad_form',
			'action' => "",
			'enableAjaxValidation' => false,
		)
		);
		echo $form->hiddenField($model,'id');
		?>
			<div class="operate_result">
			<?php $this->widget("FlashInfo");?>
			</div>
			<div class="jwy_add"><?php if($model->id) echo '广告编辑'; else echo "广告添加"; ?></div>
			<div class="input_line">
				<div class="input_name">广告位置</div>
				<div class="input_long_content">
				<?php 
					$downListData = $model->get_areas_list();
					
					if (empty($downListData))
						echo '你还没有添加广告位置';
					else 
						echo $form->dropDownList($model, 'ad_area_id', $downListData);
					?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'ad_area_id');?>
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
				<div class="input_name">广告类型</div>
				<div class="input_long_content">
				<?php echo $form->dropDownList($model,"ad_type",CV::$AD_TYPE,array()); ?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'ad_type');?>
				</div>
			</div>
			
			
			
			<div class="input_line">
				<div class="input_name"><?php echo $model->getAttributeLabel('ad_content'); ?></div>
				<div class="input_long_content">
				<?php
				$this->widget('application.extensions.fckeditor.FCKEditorWidget',
				array(
						"model"=>$model,                # Data-Model
						"attribute"=>'ad_content',         # Attribute in the Data-Model
						"height"=>'400px',
						"width"=>'100%',
						"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
						"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
						"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
						"config" => array(
				),
				));
				?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'ad_content');?>
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
