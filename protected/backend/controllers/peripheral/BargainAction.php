<?php
class BargainAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	 $this->controller->init_page();
      return true;
    }

  protected function do_action(){	
		$model=new Trave;
		$id=$_REQUEST['id'];
		$status=$_REQUEST['status'];
		if(!empty($id)){
			$model->update_table_datas($id,array('trave_bargain'=>$status));
		}
		$this->controller->redirect($this->controller->createUrl("peripheral/index",array()));
  }
 
 
    
}
?>
