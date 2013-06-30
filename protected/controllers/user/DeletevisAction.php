<?php
class DeletevisAction extends  BaseAction{
  
   protected function beforeAction(){
    	$this->controller->init_page();
    	$this->controller->user_tag='visitors';
    	return true;
    }
 
  protected function do_action(){
		//初始化数据判断是否登录没有登陆转到登陆页面并且过滤 $_REQUEST的数据
		$this->controller->init_page();
		$model=new Usercontact();
		$id=$_REQUEST['id'];
		if(!empty($id)){
			if(is_array($id)){
				foreach($id as $key => $value){
					$model->delete_table_datas($value);
				}
			}else{
			    $model->delete_table_datas($id);
			}
		}
		$this->controller->redirect($this->controller->createUrl("user/visitors",array()));
  }
 
 
    
}
?>
