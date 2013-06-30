<?php
class AddAction extends BaseAction{
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
      return true;
    }
  protected function do_action(){	
	  $id=$_REQUEST['id'];
		$model=new District;
		if(!empty($id)){
			 $this->controller->bc(array("线路区域"=>array('district/index'),'修改线路区域'));
			 $model=$model->get_table_datas($id,array(),false);
		}else{
		    $this->controller->bc(array("线路区域"=>array('district/index'),'增加线路区域'));	
		}
		$this->display('add_district',array('model'=>$model));
   	
  }
 
 
    
}
?>
