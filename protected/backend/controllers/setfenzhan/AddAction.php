<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new Cfenzhan();
  	$region_id=$_POST['region_id'];
  	if(isset($_POST['Cfenzhan'])){
  		$this->controller->bc(array("分站设置"=>array('setfenzhan/index'),"增加分站"));
  		if(!empty($_POST['Cfenzhan']['id'])){
  			$model=$model->get_table_datas($_POST['Cfenzhan']['id']);
  		}
			$model->attributes=$_POST['Cfenzhan'];
			$model->region_id=$region_id;
			if($model->validate()){
			  $model->insert_fenzhan();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("分站设置"=>array('setfenzhan/index'),"修改分站"));
			 	$model=$model->get_table_datas($id,array());
			}else{
				$this->controller->bc(array("分站设置"=>array('setfenzhan/index'),"增加分站"));	
			}
		}
		$this->display('add',array('model'=>$model));
  } 
}
?>
