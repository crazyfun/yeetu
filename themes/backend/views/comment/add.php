<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("comment/index");?>">返回到评论管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'insertcomment-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
        ?>
           <?php 
              echo $form->hiddenField($model,"id");
           ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add"><?php if($model->id) echo "评论修改"; else echo "评论添加"; ?></div>
           <div class="input_line"><div class="input_name">线路名称</div><div class="input_long_content"><?php echo CHtml::textField("trave_name",$model->Trave->trave_name,array('readonly'=>'readonly'));?></div><div class="input_error"></div><div class="clear_both"></div></div>
           <div class="input_line">
           	
           	   <div class="input_name">总体评分</div><div class="input_content"><?php echo $form->dropDownList($model,"comment_total",CV::$SEARCH_RATING_VALUES,array());?></div><div class="input_error"><?php echo $form->error($model,'comment_total'); ?></div>
           	   <div class="input_name">景点评分</div><div class="input_content"><?php echo $form->dropDownList($model,"comment_scape",CV::$SEARCH_RATING_VALUES,array());?></div><div class="input_error"><?php echo $form->error($model,'comment_scape'); ?></div>
           	   <div class="input_name">购物评分</div><div class="input_content"><?php echo $form->dropDownList($model,"comment_shop",CV::$SEARCH_RATING_VALUES,array());?></div><div class="input_error"><?php echo $form->error($model,'comment_shop'); ?></div>
           	   <div class="clear_both"></div>
           	   <div class="input_name">住宿评分</div><div class="input_content"><?php echo $form->dropDownList($model,"comment_stay",CV::$SEARCH_RATING_VALUES,array());?></div><div class="input_error"><?php echo $form->error($model,'comment_stay'); ?></div>
           	   <div class="input_name">用餐评分</div><div class="input_content"><?php echo $form->dropDownList($model,"comment_dining",CV::$SEARCH_RATING_VALUES,array());?></div><div class="input_error"><?php echo $form->error($model,'comment_dining'); ?></div>
           	   <div class="input_name">车辆评分</div><div class="input_content"><?php echo $form->dropDownList($model,"comment_cat",CV::$SEARCH_RATING_VALUES,array());?></div><div class="input_error"><?php echo $form->error($model,'comment_cat'); ?></div>
           	    <div class="clear_both"></div>
           	   <div class="input_name">导游评分</div><div class="input_content"><?php echo $form->dropDownList($model,"comment_guide",CV::$SEARCH_RATING_VALUES,array());?></div><div class="input_error"><?php echo $form->error($model,'comment_guide'); ?></div>
           	   <div class="input_name">客服评分</div><div class="input_content"><?php echo $form->dropDownList($model,"comment_server",CV::$SEARCH_RATING_VALUES,array());?></div><div class="input_error"><?php echo $form->error($model,'comment_server'); ?></div>

           	</div>
           
           <div class="input_line"><div class="input_name">点评的内容</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'comment_content',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
                                    # Additional Parameter (Can't configure a Toolbar dynamicly)
          ) ); ?>

         </div><div class="input_error"><?php echo $form->error($model,'comment_content'); ?></div><div class="clear_both"></div></div>

    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


