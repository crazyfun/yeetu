<?php
class CloneAction extends  BaseAction{
  
    public function beforeAction(){
    	  $this->controller->layout="iframe";
      	Util::reset_vars();
       	return true;
    }
  
    protected function do_action(){
    	$trave_id=$_REQUEST['trave_id'];
    	if(isset($_POST['clone_ok'])){
    	 $clone_trave_category=$_POST['clone_trave_category'];
    	 $clone_trave_package=$_POST['clone_trave_package'];
    	 $clone_free_category=$_POST['clone_free_category'];
    	 if($clone_trave_category!='5'){
    	   $clone_trave_package="0";
    	   $clone_free_category="0";
    	 }
      	$trave=new Trave();
    	  $result=$trave->clone_trave($trave_id,$clone_trave_category,$clone_trave_package,$clone_free_category);
    	  if($result){
    	  	$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
    	  }else{
    	  	$this->controller->f(CV::FAILED_ADMIN_OPERATE);
    	  }
      }
    	$this->display('clone_trave',array('trave_id'=>$trave_id,'clone_trave_category'=>$clone_trave_category,'clone_trave_package'=>$clone_trave_package,'clone_free_category'=>$clone_free_category));
    }
 
 
    
}
?>
