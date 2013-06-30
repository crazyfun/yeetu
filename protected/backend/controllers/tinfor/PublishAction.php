<?php
class PublishAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("咨询列表"));
     return true;
  }
  protected function do_action(){	
  	$model=new TravelInfor();
    $id=$_GET['id'];
    $information_status=$_GET['status'];
    $update_datas['information_status']=$information_status;
    $model->update_table_datas($id,$update_datas,array());
		$this->display('index',array('model'=>$model));
  } 
}
?>
