<ul id="topmenu">
	<?php foreach($menus as $key=>$menu){ ?>
	   <li class=""><em><a id="header_style_<?php echo $key;?>"  id="parent_<?php echo $key;?>" class="parent_menu" parent_id="<?php echo $key;?>" href="javascript:void(0);"><?php echo $menu['name'];?></a></em></li>
  <?php } ?>
  <!--<li class=""><em><a id="header_style"  id="parent" target="_blank" class="parent_menu"  href="/backend.php/helpmanual/index">帮助手册</a></em></li>-->

</ul>
<script language="javascript">
   var menu_json=<?= $menu_json; ?>;
   jQuery(document).ready(function(){
   	     var home_menu=menu_json[1];
   	     var home_subitem=home_menu.subitem;
   	     var left_menu="";
   	     var subitem_length=home_subitem.length;
   	     for(var ii=0;ii<subitem_length;ii++){
   	     	 left_menu+='<li><a target="main" id="child_'+home_subitem[ii].id+'" link="'+home_subitem[ii].url+'" href="javascript:void(0);"  class="child_menu">'+home_subitem[ii].name+'</a></li>';
   	     	}
   	     jQuery("#menu_global").html(left_menu);

   	     var first_menu=home_subitem[0];
   	     var home_link=jQuery("#child_"+String(first_menu.id)).attr("link");
   	     jQuery("#rightframe").attr("src",home_link);
   	     jQuery("#header_style_1").parent().parent().addClass("navon");
   	     jQuery("#child_"+String(first_menu.id)).addClass("tabon");
   	     jQuery(".parent_menu").bind("click",function(){
   	     	
   	     	  var parent_id=jQuery(this).attr("parent_id");
   	     	  var subitem=menu_json[parent_id].subitem;
   	     	  var left_menu="";
   	     	  var subitem_length=subitem.length;
   	     	  for(var ii=0;ii<subitem_length;ii++){
   	     	  	left_menu+='<li><a target="main" id="child_'+subitem[ii].id+'" link="'+subitem[ii].url+'" href="javascript:void(0);"  class="child_menu">'+subitem[ii].name+'</a></li>';
   	     	  }
   	     	  jQuery("#menu_global").html(left_menu);
   	     	  jQuery(".navon").removeClass("navon");
   	     	  jQuery(this).parent().parent().addClass("navon");
   	     	  var first_menu=subitem[0];
   	     	  var link=jQuery("#child_"+String(first_menu.id)).attr("link");
   	     	  jQuery("#rightframe").attr("src",link);
   	     	  jQuery(".tabon").removeClass("tabon");
   	     	  jQuery("#child_"+String(first_menu.id)).addClass("tabon");
   	     });
   	     
   	     jQuery(".child_menu").live("click",function(){
   	     	  
   	     	  var link=jQuery(this).attr("link");
   	     	  jQuery("#rightframe").attr("src",link);
   	     	  jQuery(".tabon").removeClass("tabon");
   	     	  jQuery(this).addClass("tabon");
   	     	
   	     });
   	
    });	
	
</script>


