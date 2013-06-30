<?php
class TraveareaAction extends BaseAction{
  protected function beforeAction(){
    $this->controller->init_travearea_page();
    $this->controller->bc(array("国内机+酒店"=>array('nianhui/index'),"增加国际机+酒店景区"));
     return true;
  }
  protected function do_action(){	
		$trave_id=$_REQUEST['trave_id'];
		//初始化数据判断是否登录没有登陆转到登陆页面并且过滤 $_REQUEST的数据
		$model=new Travearea;
		$model->trave_id=$trave_id;
		$this->display('trave_area',array('model'=>$model,'trave_id'=>$trave_id));
  } 
}
?>
