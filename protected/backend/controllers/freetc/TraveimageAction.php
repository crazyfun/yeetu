<?php
class TraveimageAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("国内机+酒店"=>array('freetc/index'),"增加国际机+酒店图片"));
     return true;
 
  }
  protected function do_action(){	
		$trave_id=$_REQUEST['trave_id'];
		$trave_area_id=$_REQUEST['trave_area_id'];
		//初始化数据判断是否登录没有登陆转到登陆页面并且过滤 $_REQUEST的数据
		$model=new Traveimage;
		$model->trave_id=$trave_id;
		$model->trave_area_id=$trave_area_id;
		$this->display('trave_image',array('model'=>$model));
 }
}
?>
