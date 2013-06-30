  <div class="flash" id="focusViwer">

	  <div class="f_wrapper">
	  	<div class="f_wrapperimg">
	  		<?php foreach($flash_ad_datas as $key => $value){ ?>
	  			<div id="f_<?php echo $key;?>" class="f_apic"><a target="_blank" href="<?php echo $value['ad_link'];?>"><img src="<?php echo $value['ad_src'];?>"></a></div>
	  		<?php	
	  		  }
	  		?>
	  </div>
	  <div class="f_banner">
	  		<?php foreach($flash_ad_datas as $key => $value){ ?>
	  		   <div  id="n_<?php echo $key;?>" class="f_name <?php if($key==0) echo "f_name_select";?>"><?php echo $value['ad_name'];?></div>
	  		<?php	
	  		  }
	  		?>
	 </div>
  </div>
</div>
<div class="right_pics">
        <div class="flash_right_ad_i"><?php echo Util::get_ad('6') ;?></div>
      	<div class="flash_right_ad_i"><?php echo Util::get_ad('31') ;?></div>
      	<div class="flash_right_ad_i"><?php echo Util::get_ad('32') ;?></div>
</div>
<div class="clear_float"></div>
                
                
                
<script type=text/javascript>
		 var flash_ad_json=<?= $flash_ad_length ?>;
	   var flash_ad=new slide_flashad({"imgw":"f_wrapperimg","namew":"f_banner","datas_length":flash_ad_json,"pic_width":"460","pic_heihgt":"205","text_height":"15","show_time":500,"auto":true,"auto_time":3000,"text_show":true});
	   flash_ad.rend_ad();
 
</script>
