<?php
 foreach($district_values as $key => $value){
?>
 <div class="sregion_contents"><div class="sregion_parent_content">

     <div class="sregion_name"><a href="<?php echo Yii::app()->getController()->createUrl('site/sregion',array('sregion_id'=>$key)) ?>"><?php echo $value ;?></a></div>	 

 	</div></div>
<?php
}
?>