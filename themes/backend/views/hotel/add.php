<?php
 $hotel_level=array('1'=>'一星','2'=>'二星','3'=>'三星','4'=>'四星','5'=>'五星','6'=>'六星','7'=>'七星');

?>
<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("hotel/index");?>">返回到酒店管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'insertuser-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
        ?>
           <?php 
              echo $form->hiddenField($model,"id");
           ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add"><?php if($model->id) echo "酒店修改"; else echo "酒店添加"; ?></div>
           <div class="input_line">
				<div class="input_name">酒店名称</div>
				<div class="input_content"><?php echo $form->textField($model,"hotel_name",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'hotel_name'); ?></div>
				<div class="clear_both"></div>
			</div>
			
			<div class="input_line">
				<div class="input_name">酒店星级</div>
				<div class="input_content"><?php echo $form->dropDownList($model,"hotel_level",$hotel_level,array());?></div>
				<div class="input_error"><?php echo $form->error($model,'hotel_level'); ?></div>
				<div class="clear_both"></div>
			</div>
			
			
      <div class="input_line">
				<div class="input_name">酒店地址</div>
				<div class="input_content"><?php echo $form->textField($model,"hotel_address",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'hotel_address'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">酒店电话</div>
				<div class="input_content"><?php echo $form->textField($model,"hotel_phone",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'hotel_phone'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">传真</div>
				<div class="input_content"><?php echo $form->textField($model,"hotel_fax",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'hotel_fax'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">联系人</div>
				<div class="input_content"><?php echo $form->textField($model,"hotel_link",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'hotel_link'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">挂牌价格</div>
				<div class="input_content"><?php echo $form->textField($model,"mark_price",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'mark_price'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">散客价格</div>
				<div class="input_content"><?php echo $form->textField($model,"resale_price",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'resale_price'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">团队平日价格</div>
				<div class="input_content"><?php echo $form->textField($model,"pingri_price",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'pingri_price'); ?></div>
				<div class="clear_both"></div>
			</div>
			
			<div class="input_line">
				<div class="input_name">团队周末价格</div>
				<div class="input_content"><?php echo $form->textField($model,"zhoumo_price",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'zhoumo_price'); ?></div>
				<div class="clear_both"></div>
			</div>
           <div class="input_line"><div class="input_name">酒店描述</div>
				<div class="input_long_content">
				<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
						"model"=>$model,                # Data-Model
						"attribute"=>'hotel_desc',         # Attribute in the Data-Model
						"height"=>'400px',
						"width"=>'100%',
						"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
						"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
						"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
			  ) ); ?></div>
				<div class="input_error"><?php echo $form->error($model,'hotel_desc'); ?></div>
				<div class="clear_both"></div>
		 </div>
		 <div class="input_line"><div class="input_name">备注</div>
				<div class="input_long_content">
				<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
						"model"=>$model,                # Data-Model
						"attribute"=>'hotel_comment',         # Attribute in the Data-Model
						"height"=>'400px',
						"width"=>'100%',
						"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
						"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
						"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
			  ) ); ?></div>
				<div class="input_error"><?php echo $form->error($model,'hotel_comment'); ?></div>
				<div class="clear_both"></div>
		 </div>

    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("hotel/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


