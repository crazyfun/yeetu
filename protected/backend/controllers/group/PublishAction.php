<?php
class PublishAction extends BaseAction{
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
			if(is_array($id)){
				foreach($id as $key => $value){
					$model->update_table_datas($value,array('trave_status'=>$status));
				}
			}else{
			  $model->update_table_datas($id,array('trave_status'=>$status));
			}
		}
		$this->controller->redirect($this->controller->createUrl("group/index",array()));
  }
 
 
    
}
?>
