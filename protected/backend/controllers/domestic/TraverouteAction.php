<?php
class TraverouteAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("国内游"=>array('domestic/index'),"国内游行程"));
     return true;
  }
  protected function do_action(){	
		$trave_id=$_REQUEST['trave_id'];
		//初始化数据判断是否登录没有登陆转到登陆页面并且过滤 $_REQUEST的数据
		$model=new Traveroute;
		$model->trave_id=$trave_id;
		$this->display('trave_route',array('model'=>$model,'trave_id'=>$trave_id));
  } 
}
?>
