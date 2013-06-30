<?php
class RecycleAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	 $this->controller->init_page();
      return true;
    }

  protected function do_action(){	
		$model=new Trave;
		$id=$_REQUEST['id'];
		$recycle=$_REQUEST['recycle'];
		if(!empty($id)){
			if(is_array($id)){
				foreach($id as $key => $value){
					$model->update_table_datas($id,array('recycle'=>$recycle));
				}
			}else{
			  $model->update_table_datas($id,array('recycle'=>$recycle));
			}
		}
		$this->controller->redirect($this->controller->createUrl("freetn/index",array()));
  }
 
 
    
}
?>
