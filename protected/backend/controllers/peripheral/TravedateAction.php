<?php
class TravedateAction extends BaseAction{
  
    protected function beforeAction(){
    		$this->controller->init_travedate_page();
    		 $this->controller->bc(array("周边游"=>array('peripheral/index'),"周边游时间"));
        return true;
      
    }
  protected function do_action(){	
		$trave_id=$_REQUEST['trave_id'];
		//初始化数据判断是否登录没有登陆转到登陆页面并且过滤 $_REQUEST的数据
		$model=new Travedate;
		$model->trave_id=$trave_id;
		$this->display('trave_date',array('model'=>$model,'trave_id'=>$trave_id));
  } 
}
?>
