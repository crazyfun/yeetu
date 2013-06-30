<?php
class SettleAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=new Car();
		$id=$_REQUEST['id'];
		$motorcade_id=$_REQUEST['motorcade_id'];
    $update_condition['status']='1';
    $model->update_table_datas($id,$update_condition,array());
		$this->controller->redirect($this->controller->createUrl("motorcade/car",array('motorcade_id'=>$motorcade_id)));
  } 
}
?>
