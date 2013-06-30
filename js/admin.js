jQuery(document).ready(function(){
	jQuery('.operate_dbutton').bind('click',function(){
		var txt = jQuery(this).html();
		if(txt.indexOf('删除') >= 0){
			return confirm("确定删除此记录?");
		}
	});
	
	jQuery(".input_line:even").addClass("bgcolor");
	jQuery(".input_line:odd").addClass("bgcolor_even");
	
	jQuery(".input_line").hover(
      function(){
      	jQuery(this).removeClass("bgcolor");
      	jQuery(this).addClass("bgcolor_hover");
      },
      function(){
      	jQuery(this).removeClass("bgcolor_hover");
      	jQuery(this).addClass("bgcolor");
      }
    );
    
    
    
});


function excel_export(model,params){
     var frame_dialog=new FrameDialog();
     frame_dialog.show_dialog("excel导出",{"ok_button":{},"cancel_button":{}},{"width":1000,"height":300,"FrameUrl":"/backend.php/main/export?model="+model+"&"+params,"overlay":false}); 
}

function excel_import(model){
     var frame_dialog=new FrameDialog();
     frame_dialog.show_dialog("excel导入",{"ok_button":{},"cancel_button":{}},{"width":1000,"height":300,"FrameUrl":"/backend.php/main/import?model="+model,"overlay":false}); 
	
}
