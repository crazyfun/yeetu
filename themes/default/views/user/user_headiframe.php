<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<?php 
     $this->breadcrumbs=array(
         '用户中心'=>$this->createUrl("user/index"),
     ); 
?> 
<div id="hidden_userhead-form">
	
</div>
<script language="javascript">
	    window.onload=function(){
	         var image_src="<?= $image_src ?>";
	         var file_error="<?= $file_error ?>";
	         if(file_error){
	         	   self.parent.document.getElementById("show_upload_message").innerHTML=file_error;
	         }else{
	          if(image_src){
               self.parent.head_callback("<?= $image_src ?>");
            }
           }
      }
</script>
