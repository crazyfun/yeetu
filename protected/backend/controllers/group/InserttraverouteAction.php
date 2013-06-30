<?php
class InserttraverouteAction extends BaseAction{
  protected function beforeAction(){
    $this->controller->init_page();
    $this->controller->bc(array("跟团游"=>array('group/index'),"增加跟团游行程"));
     return true;
  }
  protected function do_action(){	
		$model=new Traveroute();
		if(isset($_POST['Traveroute'])){
			 if(!empty($_POST['Traveroute']['id'])){
			   $model=$model->get_table_datas($_POST['Traveroute']['id']);	
			 }
			 $model->id=$_POST['Traveroute']['id'];
			 $model->attributes=$_POST['Traveroute'];
			 $model->trave_route=implode(",",(array)$_POST['trave_route']);
			 if($model->validate()){
		   	$model->insert_traveroute();
		   	$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		   }else{
		   	$this->controller->f(CV::FAILED_ADMIN_OPERATE);
		   }
		}
		
		$this->display('add_trave_route',array('model' => $model));
  } 
}
?>
