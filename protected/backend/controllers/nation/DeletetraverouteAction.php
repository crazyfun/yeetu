<?php
class DeletetraverouteAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=new Traveroute;
		$id=$_REQUEST['id'];
		$trave_id=$_REQUEST['trave_id'];
		if(!empty($id)){
			if(is_array($id)){
				foreach($id as $key => $value){
					$model->delete_table_datas($value);
				}
			}else{
			  $model->delete_table_datas($id);
			}
		}
		//初始化数据判断是否登录没有登陆转到登陆页面并且过滤 $_REQUEST的数据
		
		$this->controller->redirect($this->controller->createUrl("traveroute",array('trave_id'=>$trave_id)));
  } 
}
?>
