<div class="wj_tablimgb">
<div class="f_wrapper">
	  	<div class="f_wrapperimg">
	  		<?php 
	  		  $js_flash_nums=$show_nums=(count($trave_images_datas)>5)?5:count($trave_images_datas);
	  		  
	  		  foreach($trave_images_datas as $key => $value){ 
	  			if($show_nums >0 ){
	         $image_path=$value->Images->get_image_path();
  			   $image_src=$value->Images->image_src;
  			   $image_name=$value->Images->image_title;
  			   $image_path="/".$image_path;	
  			   if($key==0){
  			   	
  			 ?>
  			  <div id="f_<?php echo $key;?>" style="display:block;" class="f_fpic"><div class="f_tvertical"><a  href="javascript:show_light_box('<?php echo $value->id;?>');"><img alt="<?php echo $image_name; ?>" title="<?php echo $image_name; ?>" src="<?php echo Util::rename_thumb_file(310,285,$image_path,$image_src) ?>"/></a></div></div>
  			<?php 	
  			  }else{
       ?> 
	  			<div id="f_<?php echo $key;?>" class="f_fpic"><div class="f_tvertical"><a  href="javascript:show_light_box('<?php echo $value->id;?>');"><img alt="<?php echo $image_name; ?>" title="<?php echo $image_name; ?>" src="<?php echo Util::rename_thumb_file(310,285,$image_path,$image_src) ?>"/></a></div></div>
	  		<?php	
	  		    }
	  		    $show_nums--;
	  		   }
	  		  
	  		 }
	  		?>
	  </div>

  </div>
</div>


<ul id="gallery" style="display:none;">
	   <?php 
	       foreach($trave_images_datas as $key => $value){ 
	         $image_path=$value->Images->get_image_path();
  			   $image_src=$value->Images->image_src;
  			   $image_name=$value->Images->image_title;
  			   $image_desc=$value->Images->image_desc;
  			   $image_path="/".$image_path;	
  	?>
  			   <li><a id="clicka_<?php echo $value->id;?>" rel="lightbox[<?php echo $value->trave_area_id;?>]" title="<?php echo $image_name.(empty($image_desc)?"":(":".$image_desc));?>" href="<?php echo $image_path.$image_src; ?>"></a></li>
    <?php
  			  }  
  	?>

            	
    </ul> 

<script type=text/javascript>
		 var flash_ad_json=<?= $js_flash_nums ?>;
	   var flash_ad=new fade_flashad({"namew":"","datas_length":flash_ad_json,"pic_width":"310","pic_heihgt":"285","text_height":"","show_time":500,"auto":true,"auto_time":3000,"text_show":false});
	   flash_ad.rend_ad();
 
</script>
  
  
  
