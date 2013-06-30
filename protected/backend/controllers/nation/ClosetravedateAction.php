<?php
class ClosetravedateAction extends BaseAction{
  
    protected function beforeAction(){
    	  $this->controller->init_travedate_page();
        return true;
    }
  protected function do_action(){	
		$model=new Travedate;
		$id=$_REQUEST['id'];
		$trave_id=$_REQUEST['trave_id'];
		if(!empty($id)){
			$add_datas['trave_status']='2';
	  	$add_datas['create_id']="";
	  	$add_datas['create_time']=Util::current_time('timestamp');
	  	$update_flag=$model->update_table_datas($id,$add_datas);
		}
		//初始化数据判断是否登录没有登陆转到登陆页面并且过滤 $_REQUEST的数据
		$this->controller->redirect($this->controller->createUrl("travedate",array('trave_id'=>$trave_id)));
  } 
}
?>
