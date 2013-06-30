<?php  
 $attributeLabels=$model->attributeLabels();
 unset($attributeLabels['id']);
 unset($attributeLabels['station_id']);
 unset($attributeLabels['create_id']);
 unset($attributeLabels['create_time']);
?>
<div id="page_content">
    <div class="show_right_content">
    <!--编辑框-->	
    	<div class="edit_content">
    		<?php 
    		  $form=$this->beginWidget('CActiveForm', array('id'=>'','action'=>"",'enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data')));//'enctype'=>'multipart/form-data');
         echo $form->hiddenField($model,"id");
        ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           
           <div class="jwy_add">配置信息</div>
           <div class="input_line"><div class="input_name">上传文件:</div><div class="input_long_content"><?php echo CHtml::fileField("excellfile","",array());?></div><div class="input_error"><?php if(!empty($errors['excellfile'])) echo $errors['excellfile']; else echo "上传.xls后缀的文件";?></div></div>
           <div class="input_line"><div class="input_name">起始行:</div><div class="input_content"><?php echo CHtml::textField("start",$start,array()); ?></div><div class="input_error"><?php if(!empty($errors['start'])) echo $errors['start']; else echo "起始的行数，默认为2";?></div></div>
	         <div class="input_line"><div class="input_name">结束行:</div><div class="input_content"><?php echo CHtml::textField("end",$end,array()); ?></div><div class="input_error"><?php if(!empty($errors['end'])) echo $errors['end']; else echo "结束的行数，默认最后行";?></div></div>
	         
	         <div class="input_line"><div class="input_name">导入规则</div><div class="input_content">
	         <table class="import_rules">
	         	 <thead></thead>
	         	 <tbody>
	         <?php  
	            $col_nums=count($attributeLabels);
	            echo "<tr>";
	            echo "<td>列\字段</td>";
	            $cell_arr=CV::$cell_arr;
	            foreach($attributeLabels as $key => $value){
                echo "<td>".$value."</td>";	 
	            }
	            echo "</tr>";
	            for($ii=1;$ii<=$col_nums;$ii++){
	            	echo "<tr>";
	            	echo "<td>".$cell_arr[$ii]."</td>";
	            	foreach($attributeLabels as $key => $value){
	            		$checked=false;
	            		if($CFG[$key]==$cell_arr[$ii]){
	            			$checked=true;
	            		}
	            		$td_str=CHtml::radioButton("CFG[".$key."]",$checked,array("value"=>$cell_arr[$ii],'class'=>'checkbox','attr'=>$cell_arr[$ii]));
	            		echo "<td>".$td_str."</td>";
	            	}
	            	echo "</tr>";
	            }
	         ?>
	          </tbody>
	         </table>
	         </div>
	         <div class="input_error"><?php if(!empty($errors['CFG'])) echo $errors['CFG']; else echo "如果数据库有相同的记录则停止导入该笔数据,如果是选择框(1:男,2:女)或者是关联的数据(1:东方国际旅行社,2:国际旅行社)请查找并且修改成对应的数据类型";?></div>
	         </div>
	         <div class="input_line hasbgbot"><div class="edit_input_button"><input type="submit" class="input_submit" value="确定" name="button_ok"/><input type="reset" class="input_cancel" value="取消" name="button_reset"/></div></div>
	   
    	<?php $this->endWidget(); ?>
    	</div>
    	 <!--编辑框end-->	
    </div>
</div>

<script language="javascript">

jQuery(document).ready(function(){
	jQuery(".checkbox").bind("click",function(){
		 var attr=jQuery(this).attr("attr");
		 jQuery(".checkbox[attr='"+attr+"']").attr("checked",false);
		 jQuery(this).attr("checked",true);
	})
});
</script>
    
    



    
    
    
    
    



