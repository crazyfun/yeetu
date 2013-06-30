<div id="page_content">
    <div class="show_right_content">
    	
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href='<?php echo $this->createUrl("freetn/index",array());?>'>返回到国际机+酒店</a></span></div></div>
    	
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserttrave-form',
          'action'=>$this->createUrl("freetn/addfreetn",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
        
    		<?php echo $form->hiddenField($model,"id");?>
    		<div class="operate_result"><?php $this->widget("FlashInfo");?></div>
          	<div class="jwy_add"><?php if($model->id) echo "国际机+酒店修改"; else echo "国际机+酒店添加"; ?></div>
    		<div class="input_line"><div class="input_name">线路名称</div><div class="input_long_content"><?php echo $form->textField($model,"trave_name");?></div><div class="input_error"><?php echo $form->error($model,'trave_name'); ?></div><div><a href="javascript:show_clonedialog('<?php echo $model->id; ?>')">克隆线路</a></div><div class="clear_both"></div></div>
    		
    		<?php echo $form->hiddenField($model,"trave_suppliers",array('id'=>'trave_suppliers'));?>
			  <div class="input_line"><div class="input_name">供应商</div><div class="input_long_content"><?php echo CHtml::textField('trave_suppliers_name',$model->Agency->agency_name,array('id'=>'select_trave_suppliers_name','autocomplete'=>'off'));?></div><div class="input_error"><?php echo $form->error($model,'trave_suppliers'); ?></div></div>

    		<div class="input_line"><div class="input_name">供应商线路编号</div><div class="input_long_content"><?php echo $form->textField($model,"trave_suppliers_number");?></div><div class="input_error"><?php echo $form->error($model,'trave_suppliers_number'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class="input_content"><?php echo $form->checkBox($model,"trave_ordain",array('value'=>'1'));?>立即预定</div><div class="input_content"><?php echo $form->checkBox($model,"show_index",array('value'=>'1'));?>是否首页显示</div><div class="input_error"><?php echo $form->error($model,'trave_ordain'); ?></div><div class="input_error"><?php echo $form->error($model,'show_index'); ?></div><div class="clear_both"></div></div>
			  <div class="input_line"><div class="input_name">默认订单数</div><div class="input_long_content"><?php echo $form->textField($model,"system_indent");?></div><div class="input_error"><?php echo $form->error($model,'system_indent'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">出行天数</div><div class="input_long_content"><?php echo $form->textField($model,"trave_route_number");?></div><div class="input_error"><?php echo $form->error($model,'trave_route_number'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">价格范围</div><div class="input_long_content"><?php echo $form->dropDownList($model,"trave_budget",CV::$BUDGET_DATAS,array());?></div><div class="input_error"><?php echo $form->error($model,'trave_budget'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">抵用劵</div><div class="input_long_content"><?php echo $form->textField($model,"coupon");?></div><div class="input_error"><?php echo $form->error($model,'coupon'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">套餐</div><div class="input_long_content"><?php echo $form->dropDownList($model,"is_package",CV::$PACKAGE,array()) ?></div><div class="input_error"><?php echo $form->error($model,'is_package'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">入住酒店</div><div class="input_long_content"><input  type="hidden" id="trave_hotels_id" name="trave_hotels_id" value="<?php echo $model->trave_hotels;?>"><input readonly id="trave_hotels" onclick='javascript:select_trave_hotels(<?php echo $hotels_datas_json; ?>);' type="text" name="trave_hotels" value="<?php echo $trave_hotels_name; ?>"/></div><div class="input_error"><?php echo $form->error($model,'trave_hotels'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">线路始发地</div><div class="input_long_content">
    		<?php 
                $sregion_datas=Cfenzhan::model()->get_fenzhan_permissions();
		            echo $form->dropDownList($model,"trave_sregion",$sregion_datas,array());
		     ?></div>
		     <div class="input_error"><?php echo $form->error($model,'trave_sregion'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">线路目的地</div><div class="input_long_content"><input  type="hidden" id="trave_region_id" name="trave_region_id" value="<?php echo $model->trave_region;?>"><input readonly id="trave_region" onclick="javascript:select_city([{'id':'<?php echo $model->trave_region;?>','name':'<?php echo $trave_region_name; ?>'}]);" type="text" name="trave_region" value="<?php echo $trave_region_name; ?>"/></div><div class="input_error"><?php echo $form->error($model,'trave_region'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">线路类别选择</div><div class="input_long_content"><input type="hidden" id="trave_linetype_id" name="trave_linetype_id" value="<?php echo $model->trave_linetype;?>"><input readonly type="text" id="trave_linetype" onclick='javascript:select_linetype(<?php echo $category_datas_json; ?>);' name="trave_linetype" value="<?php echo $category_region_name;?>"/></div><div class="input_error"><?php echo $form->error($model,'trave_linetype'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">简短描述</div><div class="input_long_content">
        	<?php echo $form->textArea($model,"trave_shot_desc",array()); ?>
       </div><div class="input_error"><?php echo $form->error($model,'trave_shot_desc'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">接待标准</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'trave_receptionstandards',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          ) ); ?>

</div><div class="input_error"><?php echo $form->error($model,'trave_receptionstandards'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">特色推荐</div><div class="input_long_content">
        <?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'trave_recommended',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          ) ); ?>	
        	
        	</div><div class="input_error"><?php echo $form->error($model,'trave_recommended'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">自费项目</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'trave_tour',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          ) ); 
        ?></div><div class="input_error"><?php echo $form->error($model,'trave_tour'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">预订通知</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'trave_booknotice',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          ) ); 
        ?>
        	
        </div><div class="input_error"><?php echo $form->error($model,'trave_booknotice'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">温馨提示</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'trave_tips',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          ) ); 
        ?>
        	
        </div><div class="input_error"><?php echo $form->error($model,'trave_tips'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">提前报名</div><div class="input_long_content"><?php echo $form->textField($model,"trave_application");?></div><div class="input_error"><?php echo $form->error($model,'trave_application'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">往返交通</div><div class="input_long_content"><?php echo $form->textField($model,"trave_transportation");?></div><div class="input_error"><?php echo $form->error($model,'trave_transportation'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">优化线路</div><div class="input_long_content"><?php echo $form->textField($model,"trave_optimization");?></div><div class="input_error"><?php echo $form->error($model,'trave_optimization'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">线路标题</div><div class="input_long_content"><?php echo $form->textField($model,"trave_title");?></div><div class="input_error"><?php echo $form->error($model,'trave_title'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"提交"));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("name"=>"reset","id"=>"reset","value"=>"重置"));?></div><div class="add_more"><?php echo CHtml::link("新增",array("freetn/add"));?></div>
    		
    		<div class="add_button"><a href="#page_content">返回到顶部</a></div>	
    			
    		<div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>
    
    
    <script language="javascript">
	jQuery(function($) {
		
		 jQuery('#select_trave_suppliers_name').autocomplete({ 
    	  serviceUrl:'/backend.php/main/compeletesuppliers',
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
    	  	jQuery("#trave_suppliers").val(data.id);
  
    	  }
 
    });
    
     jQuery('#select_trave_suppliers_name').keyup(function(){
 
      var this_val=jQuery(this).val();
     
      if(!this_val){
    	   jQuery("#trave_suppliers").val('');
      }	
  	
    });
		
	 }); 
</script>

