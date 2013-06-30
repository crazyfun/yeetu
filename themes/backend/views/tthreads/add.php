<div id="page_content">
	<div class="show_right_content">
		<div class="edit_content">
		<?php
		$form=$this->beginWidget('CActiveForm',
		array(
			'id' => 'threads_form',
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
			<div class="jwy_add"><?php if($model->id) echo '线路游记/攻略编辑'; else echo "线路游记/攻略添加"; ?></div>
			
			<div class="input_line">
				<div class="input_name">线路名称</div>
				<div class="input_long_content">
			   <?php 
			          echo $form->hiddenField($model,"trave_id",array('id'=>'trave_id'));
		            echo CHtml::textField('trave_name',$model->Trave->trave_name,array('id'=>'select_trave_name','autocomplete'=>'off'));
		     ?>
				</div>
				<div class="input_error">
				 <?php echo $form->error($model, 'trave_id');?>
				</div>
			</div>
			
			
			<div class="input_line">
				<div class="input_name">上传主题图片</div>
				<div class="input_long_content">
				  <?php echo $form->FileField($model,'image_src');?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'image_src');?>
				</div>
			</div>
			<?php if($model->id){ ?><div class="input_line"><div class="input_name">&nbsp;&nbsp;</div><div class="input_content"><?php  echo CHtml::checkBox("select_image",1,array('checked'=>"checked")).$model->get_threads_image();?></div></div><?php } ?>
			
			<div class="input_line">
				<div class="input_name">主题名称</div>
				<div class="input_long_content">
				   <?php echo $form->textField($model,'title');?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'title');?>
				</div>
			</div>
			
			<div class="input_line">
				<div class="input_name">作者</div>
				<div class="input_long_content">
				   <?php echo $form->textField($model,'auther');?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'auther');?>
				</div>
			</div>
			
			
			<div class="input_line">
				<div class="input_name">主题连接</div>
				<div class="input_long_content">
			      <?php echo $form->textField($model,"title_href",array());?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'title_href');?>
				</div>
			</div>
			
			
			
			<div class="input_line">
				<div class="input_name">主题排序</div>
				<div class="input_long_content">
				   <?php echo $form->textField($model,'sort');?>
				</div>
				<div class="input_error">
				<?php echo $form->error($model, 'sort');?>
				</div>
			</div>
			
			
			<div class="input_line"><div class="input_name">简短描述</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model, # Data-Model
   					"attribute"=>'short_desc',# Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu', # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",# Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",# Realtive Path to the Editor (from Web-Root)
          )); ?>
       </div><div class="input_error"><?php echo $form->error($model,'short_desc'); ?></div><div class="clear_both"></div></div>
       	
       	
       	
			
			
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
	
	 <div id="float_big_image">
      <img id="show_big_image"/>
   </div>
</div>
<!-- /#page_content -->

<script language="javascript">
		jQuery(function($) {
	  // Your code using failsafe $ alias here...
    	 jQuery('#select_trave_name').autocomplete({ 
    	  serviceUrl:'/backend.php/main/compeletetrave',
    	  minChars:1, 
    	  delimiter: /(,|;)\s*/, // regex or character
    	  maxHeight:400,
    	  width:490,
    	  zIndex: 9999,
    	  deferRequestBy: 0, //miliseconds
    	 // params: { country:'Yes' }, //aditional parameters
    	  noCache: true, //default is false, set to true to disable caching
    	  // callback function:
    	  onSelect: function(value, data){
    	  	jQuery("#trave_id").val(data.trave_id);
    	  }
    	  // local autosugest options:
   	   //lookup: ['January', 'February', 'March', 'April', 'May'] //local lookup values 
    });
  
   
   jQuery('#select_trave_name').keyup(function(){
      var this_val=jQuery(this).val();
      if(!this_val){
    	   jQuery("#trave_id").val('');
    	   trave_id='';
    	   trave_category='';
    	   free_package='';
      }	
  	
    });
    
  });
</script>
